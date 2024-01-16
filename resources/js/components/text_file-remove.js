document.addEventListener('DOMContentLoaded', function(){
    document.querySelector('.text_file-remove').addEventListener('click', function (e) {
        e.preventDefault()

        const btn = this;
        axios.delete(btn.dataset.route, {
            responseType: 'json'
        })
        .then(function (response) {
            btn.parentElement.remove();
        })
        .catch(function (error) {
            console.log('error status', error.status)
            console.log('error message', error.data.message)
        })
    });

});