<?php
include 'components/connect.php';
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

// 🔹 1. Get All Categories
if ($action === 'get_categories') {
    $stmt = $conn->prepare("SELECT DISTINCT category FROM products");
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));
    exit;
}

// 🔹 2. Get Tags by Category
if ($action === 'get_tags') {
    $category = $_GET['category'] ?? '';
    $stmt = $conn->prepare("SELECT name FROM tags WHERE category = ? ORDER BY weight DESC, name ASC");
    $stmt->execute([$category]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));
    exit;
}

// 🔹 3. Get Ingredients by Category + Tag
if ($action === 'get_ingredients') {
    $category = $_GET['category'] ?? '';
    $tag = $_GET['tag'] ?? '';
    $stmt = $conn->prepare("
        SELECT igi.ingredient
        FROM ingredient_groups ig
        JOIN ingredient_group_items igi ON ig.id = igi.group_id
        WHERE ig.category = ? AND ig.tag = ?
        ORDER BY igi.weight DESC, igi.ingredient ASC
    ");
    $stmt->execute([$category, $tag]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));
    exit;
}

// 🔹 4. Get Price Ranges
if ($action === 'get_price_ranges') {
    $category = $_GET['category'] ?? '';
    $tag = $_GET['tag'] ?? '';
    $ingredient = $_GET['ingredient'] ?? '';

    $sql = "SELECT DISTINCT price FROM products WHERE category = ?";
    $params = [$category];

    if ($tag) {
        $sql .= " AND tags LIKE ?";
        $params[] = "%$tag%";
    }
    if ($ingredient) {
        $sql .= " AND ingredients LIKE ?";
        $params[] = "%$ingredient%";
    }

    $sql .= " ORDER BY price ASC";

    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $prices = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $ranges = array_map(function($p) { return '$' . number_format($p, 2); }, $prices);
    if (empty($ranges)) $ranges[] = "Any";

    echo json_encode($ranges);
    exit;
}

// 🔹 5. Boost Ingredient Weight
if ($action === 'boost_weight') {
    $data = json_decode(file_get_contents('php://input'), true);
    $category = $data['category'] ?? '';
    $tag = $data['tag'] ?? '';
    $ingredient = $data['ingredient'] ?? '';

    $stmt = $conn->prepare("
        UPDATE ingredient_group_items igi
        JOIN ingredient_groups ig ON ig.id = igi.group_id
        SET igi.weight = igi.weight + 1
        WHERE ig.category = ? AND ig.tag = ? AND igi.ingredient = ?
    ");
    $stmt->execute([$category, $tag, $ingredient]);

    echo json_encode(['status' => 'success']);
    exit;
}

// 🔹 6. Boost Tag Weight
if ($action === 'boost_tag') {
    $data = json_decode(file_get_contents('php://input'), true);
    $category = $data['category'] ?? '';
    $tag = $data['tag'] ?? '';

    $stmt = $conn->prepare("UPDATE tags SET weight = weight + 1 WHERE category = ? AND name = ?");
    $stmt->execute([$category, $tag]);

    echo json_encode(['status' => 'success']);
    exit;
}

// 🔹 7. Get Final Recommendations
if ($action === 'get_recommendations') {
    session_start();
    $user_id = $_SESSION['user_id'] ?? null;
    $data = json_decode(file_get_contents('php://input'), true);

    $category = $data['category'] ?? '';
    $tag = $data['tag'] ?? '';
    $ingredient = $data['ingredient'] ?? '';
    $priceRange = $data['priceRange'] ?? '';

    function fetchMealsWithRelaxation($conn, $category, $tag, $ingredient, $priceRange) {
        $base_sql = "SELECT * FROM products WHERE category = ? AND tags LIKE ?";
        $params_base = [$category, "%$tag%"];
        $items = [];

        $price_clause = '';
        $price_params = [];

        if ($priceRange) {
            $clean = floatval(str_replace(['$', ' '], '', $priceRange));

            if (strpos($priceRange, 'Under $') !== false) {
                $price_clause = " AND price < ?";
                $price_params = [$clean];
            } elseif (strpos($priceRange, 'Above $') !== false) {
                $price_clause = " AND price >= ?";
                $price_params = [$clean];
            } elseif (preg_match('/\$(\d+(\.\d+)?)\s*-\s*\$(\d+(\.\d+)?)/', $priceRange, $m)) {
                $price_clause = " AND price BETWEEN ? AND ?";
                $price_params = [floatval($m[1]), floatval($m[3])];
            } else {
                // Exact price match (default case)
                $price_clause = " AND price = ?";
                $price_params = [$clean];
            }
        }

        // 1. All filters
        $stmt = $conn->prepare($base_sql . " AND ingredients LIKE ?" . $price_clause);
        $stmt->execute(array_merge($params_base, ["%$ingredient%"], $price_params));
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($items)) return ['items' => $items, 'fallback_level' => 0];

        // 2. No price
        $stmt = $conn->prepare($base_sql . " AND ingredients LIKE ?");
        $stmt->execute(array_merge($params_base, ["%$ingredient%"]));
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($items)) return ['items' => $items, 'fallback_level' => 1];

        // 3. No ingredient
        $stmt = $conn->prepare($base_sql . $price_clause);
        $stmt->execute(array_merge($params_base, $price_params));
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($items)) return ['items' => $items, 'fallback_level' => 2];

        // 4. Only category + tag
        $stmt = $conn->prepare($base_sql);
        $stmt->execute($params_base);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ['items' => $items, 'fallback_level' => 3];
    }

    $result = fetchMealsWithRelaxation($conn, $category, $tag, $ingredient, $priceRange);
    echo json_encode($result);
    exit;
}
