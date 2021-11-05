require('./bootstrap');

// primo metodo

// window.confirmDelete = function() {
//     const resp= confirm('vuoi cancellare?');

//     if(!resp) {
//         // non lancia la richiesta al server
//         event.preventDefault();
//     }

// }

let deleteform = document.querySelectorAll('.delete-post')

deleteform.forEach(item => {
    item.addEventListener('submit', function(e){
        const resp = confirm('Vuoi cancellare?');

        if(!resp) {
            e.preventDefault();
        }
    })
})