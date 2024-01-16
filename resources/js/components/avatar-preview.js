document.addEventListener('DOMContentLoaded', function() {
    if(window.FileReader) {
        document.querySelector('#avatar').onchange = function () {
            document.querySelector('.avatar-preview').innerHTML = '';
            const reader = new FileReader();
            reader.onloadend = function (e) {
                let child = document.createElement('div');
                let template = '<img src="_url_" />';
                child.innerHTML = template.replace('_url_', e.target.result);
                document.querySelector('.avatar-preview').appendChild(child);
            }
            reader.readAsDataURL(this.files[0]) 
        }
    }
});
