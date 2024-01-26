document.addEventListener('DOMContentLoaded', function(){
    if(window.FileReader) {
        if (document.querySelector('#files') !== null) {
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
                            child.classList.add('mb-4');
                            if (file.type.split('/', 1).shift() === 'image') {
                                child.classList.add('border');
                                child.classList.add('border-gray-500');
                                template = '<img src="_url_" />';
                                child.innerHTML = template.replace('_url_', e.target.result);
                            } else {
                                child.classList.add('text-gray-700');
                                child.classList.add('text-sm');
                                template = '<i class="fa fa-paperclip text-xs" aria-hidden="true"></i>  _name_';
                                child.innerHTML = template.replace('_name_', file.name);
                            }
                            document.querySelector('.files-wrapper').appendChild(child);
                        };
                    })(file)
                    reader.readAsDataURL(file)       
                }
            } 
        }          
    }
});
