if(document.querySelector(".button_menu"))
{
  let button_menu = document.getElementById("button_menu");
  let header__menu_open = false;
  button_menu.onclick = () => {
    let header__menu = document.getElementById("header__menu")
    if(header__menu_open)
    {
      header__menu.setAttribute("hidden", true);
      header__menu.classList.add("hide");
      header__menu_open = false;
    }
    else
    {
      header__menu.removeAttribute("hidden");
      header__menu.classList.remove("hide")
      header__menu_open = true;
    }
}
}

if(document.querySelector('.internet__text_button'))
{
  let details_button = document.getElementById('details');//document.getElementId("details");
  let text_active= false;
  details_button.onclick = function() 
  {
    if(!text_active)
    {
      let text = document.getElementById('text');
      text.classList.add("internet__text_active");
      text_active = true;
    }
    else
    {
      let text = document.getElementById('text');
      text.classList.remove("internet__text_active");
      text_active = false;
    }
  }
}

if(document.querySelector(".region"))
{
  let region_button = document.getElementById("region")
  region_button.onclick = function()
  {
    let dialog = document.getElementById('region__dialog');
    if(dialog.classList.contains("region__dialog_active"))
      dialog.classList.remove("region__dialog_active");
    else
    {
      let dialog1 = document.getElementById('region__dialog_question');
      if(dialog1.classList.contains("region__dialog_active"))
      {
        dialog1.classList.remove("region__dialog_active");
        let dialog2 = document.getElementById('region__dialog_select');
        dialog2.classList.add("region__dialog_active");
      }
      dialog.classList.add("region__dialog_active");
    }
  }
  let region_dialog_button_yes = document.getElementById("region_dialog_button_yes")
region_dialog_button_yes.onclick = function()
{
  let dialog = document.getElementById('region__dialog');
  dialog.classList.remove("region__dialog_active");
}

let region_dialog_button_no = document.getElementById("region_dialog_button_not")
region_dialog_button_no.onclick = function()
{
  let dialog1 = document.getElementById('region__dialog_question');
  dialog1.classList.remove("region__dialog_active");
  let dialog2 = document.getElementById('region__dialog_select');
  dialog2.classList.add("region__dialog_active");
}

let region_search = document.getElementById("region_search");
region_search.oninput = function()
{
  let items = document.querySelectorAll('.region__dialog_item_change');
  if(region_search.value != "")
  {
    for(let i = 0; i < items.length; i++)
    {
      items[i].classList.add('hide');
      if(items[i].innerHTML.toLowerCase().includes(region_search.value.toLowerCase()))
      {
        items[i].classList.remove('hide');
      }
    }
  }
  else
  {
    for(let i = 0; i < items.length; i++)
    {
      items[i].classList.add('hide');
    }
  }
}

}


/*if(document.querySelector('.region__dialog_item_change'))
{
  let regions = document.querySelectorAll('.region__dialog_item_change')
  
  for(let i = 0; i < regions.length; i++)
  {
    regions[i].onclick = function()
    {
      document.cookie = 'region=' + regions[i].getAttribute('data-region');
      //alert('region=' + regions[i].getAttribute('data-region'));
      //location.reload();
    }
  }
}*/


if (document.querySelector('.swiper'))
{
  const swiper = new Swiper('.swiper', 
  {
    // Optional parameters
    direction: 'horizontal',
    loop: false,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },
  });
}

if (document.querySelector('.swiper_licenses'))
{
  const swiper_licenses = new Swiper('.swiper_licenses', 
  {
    // Optional parameters
    direction: 'horizontal',
    loop: true,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper_licenses-button-next',
      prevEl: '.swiper_licenses-button-prev',
    },

    // And if we need scrollbar
    /*scrollbar: {
      el: '.swiper-scrollbar',
    },*/
  });
}

if (document.querySelector('.swiper_internet'))
{
  const swiper_internet = new Swiper('.swiper_internet', 
  {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    autoplay: {
      delay: 5000,
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    /*scrollbar: {
      el: '.swiper-scrollbar',
    },*/
  });
}

if (document.querySelector('.swiper_stocks'))
{
  /*var swiper__stocks = new Swiper('.swiper__stocks', {
    
    direction: 'horizontal',
    loop: false,

    pagination: {
      el: '.swiper__stocks-pagination',
      clickable: true,
      renderBullet: function (index, className) {
        return '<span class="' + className + '">' + (index + 1) + '</span>';
      },
    },
  });*/
  const swiper_stocks = new Swiper('.swiper_stocks', 
  {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    slidesPerView: 1,
    // If we need pagination
    pagination: {
      bulletClass: '.swiper_stocks-pagination-bullet',
      el: '.swiper_stocks-pagination',
      //type: 'bullets',
      //clickable: true,
      clickableClass: 'swiper_stocks-pagination-clickable',
      clickable: true,
      renderBullet: function (index, className) {
          return '<span class="' + className + '">' + (index + 1) + '</span>';
      },
    },
  });
  let bullet = document.querySelectorAll('.stocks__nav_item');
  for(let i = 0; i < bullet.length; i++)
  {
    bullet[i].onclick = function()
    {
      if(document.querySelector('.stocks__nav_item_active'))
      {  
        let active_bullet = document.querySelector('.stocks__nav_item_active');
        active_bullet.classList.remove('stocks__nav_item_active');
      }
      let index = bullet[i].getAttribute('data-index');
      bullet[i].classList.add('stocks__nav_item_active');
      swiper_stocks.slideTo(index, 100, true);
    }
  }
}

if (document.querySelector('.modal_go'))
{
  let button = document.querySelectorAll('.modal_go');
  for (let i = 0; i < button.length; i++){
      button[i].addEventListener('click', function(e)
      {
          e.preventDefault();
          document.body.style.overflow = 'hidden';
          //let service = this.getAttribute('data-service');
          let modal = document.querySelector('.modal');
          if (modal)// && service)
          {
            modal.style.display = 'block';
            let title = button[i].getAttribute('data-service');
            let modal_button = document.getElementById('modal_button');
            let modal_title = document.getElementById('modal_title');
            modal_title.innerHTML = title;
            modal_button.innerHTML = title;
            modal_button.setAttribute('data-service', title);
            
            setTimeout(()=>modal.style.opacity = '1', 50);
          }
      }
      );
  }
}

if(document.querySelector('.vacancy__form'))
{
  let submit_button = document.querySelector('.vacancy__form_button');
  submit_button.onclick = function()
  {
    let name = document.querySelector('.vacancy__form_name').value;
    let phone = document.querySelector('.vacancy__form_phone').value;
    let vacancy = document.querySelector('.vacancy__form_vacancy').value;
    let resume = document.querySelector('.vacancy__form_resume').value;
    let ischecked = document.getElementById('check-vacancy').checked;
    var formData = new FormData();
    if(ischecked == true)
    {
      if(name.length > 1 && phone.length > 1 && vacancy.length > 1 && resume.length > 1)
      {
        formData.append('name', name);
        formData.append('phone', phone);
        formData.append('vacancy', vacancy);
        formData.append('resume', resume);
        submit_button.insertAdjacentHTML("beforeBegin", "Данные успешно отправлены");
        fetch('/send_form/vacancy', {
          method: 'POST',
          body: formData
        });
      }
      else
        alert('Не все поля формы заполнены');
    }
    else
      alert('Пожалуйста, ознакомьтесь с политикой конфиденциальности');
  }
}

if(document.querySelector('.support__form'))
{
  let submit_button = document.querySelector('.support__form_button');
  submit_button.onclick = function()
  {
    let name = document.querySelector('.support__solution_form_name').value;
    let phone = document.querySelector('.support__solution_form_phone').value;
    let problem = document.querySelector('.support__solution_form_problem').value;
    let region = document.querySelector('.region__val').getAttribute('data-region');
    let ischecked = document.getElementById('check-support').checked;
    var formData = new FormData();
    if(ischecked)
    {
      if((name.length > 1) && (phone.length > 1) && (problem.length > 1))
      {
        formData.append('name', name);
        formData.append('phone', phone);
        formData.append('problem', problem);
        formData.append('region', region);
        submit_button.insertAdjacentHTML("beforeBegin", "Данные успешно отправлены");
        fetch('/send_form/support_application', {
          method: 'POST',
          body: formData
        });
      }
      else
        alert('Не все поля формы заполнены');
    }
    else
    {
      alert('Пожалуйста, ознакомьтесь с политикой конфиденциальности');
    }
  }
}

if (document.querySelector('.modal_close')){
  document.querySelector('.modal_close').addEventListener('click', ()=>{
      let modal = document.querySelector('.modal');
      if (modal){
          modal.classList.remove('modal_show');
          modal.style.opacity = '0';
          document.body.style.overflow = 'auto';
          setTimeout(()=>{
              modal.style.display = 'none';
              //modal.querySelector('.form__wrapper_select_clients').style.display = 'none';
          }, 325);
      }
  });
}

/*if(document.querySelector('.rate__button'))
{
  var buttons = document.querySelectorAll('.rate__button');
  for(let i = 0; i < buttons.length; i++)
  {
    buttons[i].onclick = function(e)
    {
      e.preventDefault();
          document.body.style.overflow = 'hidden';
          //let service = this.getAttribute('data-service');
          let modal = document.querySelector('.modal');
          if (modal)// && service)
          {
            //modal.classList.add('modal_show')
            ///modal.querySelector('.form__wrapper_select_clients').style.display = 'block';
            //modal.querySelector('#select_service').innerText = service;
            modal.style.display = 'block';

            setTimeout(()=>modal.style.opacity = '1', 50);
          }
    }
  }
}*/

//let modal_button = document.querySelector('modal_form_button_connect-internet')
if(document.querySelector('.modal-button'))
{
  let buttons = document.querySelectorAll('.modal-button')
  {
    for(let i = 0; i < buttons.length; i++)
    {
      buttons[i].onclick = function()
      {
        
      }
    }
  }
}


let modal_button = document.getElementById('modal_button');
if(modal_button != null)
{
  modal_button.onclick = function()
  {
    let name = document.getElementById('name-main').value;
    let phone = document.getElementById('phone-main').value;
    let type = modal_button.innerHTML;
    var formData = new FormData();
    let ischecked = document.getElementById('check-main-modal').checked;
    if(ischecked)
    {
      if(name.length > 1 && phone.length > 1)
      {
        formData.append('name', name);
        formData.append('phone', phone);
        formData.append('type', type);
        modal_button.insertAdjacentHTML("afterEnd", "Данные успешно отправлены");
        let modal_title = document.getElementById('modal_title');
        modal_title.insertAdjacentHTML('afterend', '<a style = "background: #104f92!important; border-radius: 10px; color: #FFFFFF; padding: 10px 20px;" href = "' + document.baseURI + '">Вернуться на предыдущую страницу</a>');
        fetch('/send_form', {
          method: 'POST',
          body: formData
        });
        window.setTimeout(function(){

          // Move to a new location or you can do something else
          window.location.reload();

      }, 5000);
      }
      else
        alert('Не все поля формы заполнены');
    }
    else
      alert('Пожалуйста, ознакомтесь с политикой конфиденциальности')
  }
}


function tv_new_modal_submit()
{
  if(document.querySelector('.btn_form'))
  {
    alert("bvfdbd");
    let name = document.getElementById('modal_name').value;
    let phone = document.getElementById('modal_phone').value;
    let type = document.getElementById('modal_rate').value;
    var formData = new FormData();
    formData.append('name', name);
    formData.append('phone', phone);
    formData.append('type', type);
    let modal_title = document.getElementById('modal_title');
    fetch('/send_form', {
      method: 'POST',
      body: formData
    });
    /*window.setTimeout(function(){

      window.location.reload();

    }, 5000);*/
  }    
}

if(document.querySelector('.stocks__nav_bullet'))
{
  
}