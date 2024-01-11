document.addEventListener('DOMContentLoaded', function(){
    if(window.FileReader) {
        document.querySelector('#files').onchange = function () {
            let counter = 0, file
            const template = '<img src="_url_" />';

            document.querySelector('.files-wrapper').innerHTML = '';

            while (file = this.files[counter++]) { 
                const reader = new FileReader();
                reader.onloadend = (function (file) {
                    return function (e) {
                        let child = document.createElement('div');
                        child.classList.add('mb-4');
                        if (file.type.split('/', 1).shift() === 'image') {
                            child.innerHTML = template.replace('_url_', e.target.result);
                        } else {
                            child.classList.add('rounded-lg');
                            child.classList.add('border');
                            child.classList.add('border-gray-500');
                            child.classList.add('text-center');
                            child.classList.add('text-sm');
                            child.classList.add('text-gray-700');
                            child.innerHTML = file.name
                        }
                        document.querySelector('.files-wrapper').appendChild(child);
                    };
                })(file)
                reader.readAsDataURL(file)                
            }
        }        
    }
});
