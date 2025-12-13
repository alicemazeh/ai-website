navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

document.addEventListener('DOMContentLoaded', () => {

   const navbar = document.querySelector('.header .flex .navbar');
   const profile = document.querySelector('.header .flex .profile');
   const menuBtn = document.querySelector('#menu-btn');
   const userBtn = document.querySelector('#user-btn');
   const loaderEl = document.querySelector('.loader');

   if(menuBtn){
      menuBtn.onclick = () => {
         navbar.classList.toggle('active');
         profile.classList.remove('active');
      };
   }

   if(userBtn){
      userBtn.onclick = () => {
         profile.classList.toggle('active');
         navbar.classList.remove('active');
      };
   }

   window.onscroll = () => {
      navbar.classList.remove('active');
      profile.classList.remove('active');
   };

   function loader() {
      if(loaderEl){
         loaderEl.style.display = 'none';
      }
   }

   function fadeOut(){
      setTimeout(loader, 2000);
   }

   fadeOut(); // Called after DOM is ready

   document.querySelectorAll('input[type="number"]').forEach(numberInput => {
      numberInput.oninput = () => {
         if(numberInput.value.length > numberInput.maxLength){
            numberInput.value = numberInput.value.slice(0, numberInput.maxLength);
         }
      };
   });

}); // End of DOMContentLoaded
