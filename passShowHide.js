const container = document.querySelector('.container'),
      passShowHide = document.querySelectorAll('.showHidePW'),
      pass= document.querySelectorAll('.password');

      passShowHide.forEach(icon =>
        icon.addEventListener('click', ()=>{
            pass.forEach(eyeIcon => {
                if(eyeIcon.type === 'password'){
                    eyeIcon.type = 'text';

                    passShowHide.forEach(icons =>{
                        icons.classList.replace('uil-eye-slash', 'uil-eye')
                    })

                }else{
                    eyeIcon.type = 'password';

                    passShowHide.forEach(icons =>{
                        icons.classList.replace('uil-eye', 'uil-eye-slash')
                    })
                }
            })
        })
        )