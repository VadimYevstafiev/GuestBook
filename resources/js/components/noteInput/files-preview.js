document.addEventListener('DOMContentLoaded', function(){
    if(window.FileReader) {
        document.querySelector('#files').onchange = function () {
            let counter = 0, file
            let template;

            document.querySelector('.files-wrapper').innerHTML = '';

            while (file = this.files[counter++]) { 
                const reader = new FileReader();
                reader.onloadend = (function (file) {
                    return function (e) {
                        let child = document.createElement('div');
                        child.classList.add('relative');
                        child.classList.add('rounded-lg');
                        child.classList.add('border');
                        child.classList.add('border-gray-500');
                        child.classList.add('mb-4');
                        if (file.type.split('/', 1).shift() === 'image') {
                            template = '<img src="_url_" />';
                            child.innerHTML = template.replace('_url_', e.target.result);
                        } else {
                            template = '<iframe src="_url_" class="w-full"/></iframe>';
                            child.innerHTML = template.replace('_url_', e.target.result);
                        }
                        document.querySelector('.files-wrapper').appendChild(child);
                    };
                })(file)
                reader.readAsDataURL(file)                
            }
        }        
    }
});
