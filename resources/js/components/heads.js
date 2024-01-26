const btn = document.querySelector('#setting');
const sort = document.querySelector('#sort-selector');

if (btn !== null) {
    btn.addEventListener('click', function () {
        sort.classList.toggle('hidden');
    });
}
 