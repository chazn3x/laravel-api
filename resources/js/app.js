require('./bootstrap');

// Submit event
if (document.getElementById('_update')) {
    const form = document.getElementById('_update')
    const published = document.getElementById('published')
    
    const save = document.getElementById('save')
    save.addEventListener('click', (e) => {
        e.preventDefault();
        published.value = ''
        form.submit()
    })
    
    const publish = document.getElementById('publish')
    publish.addEventListener('click', (e) => {
        e.preventDefault();
        published.value = '1'
        form.submit()
    })
}

// Back event without previous edit
if (document.getElementById('_back')) {
    const back = document.getElementById('_back')

    back.addEventListener('click', (e) => {
        e.preventDefault()
        history.back()
    })
}
// Back event with previous edit
if (document.getElementById('_back2')) {
    const back = document.getElementById('_back2')

    back.addEventListener('click', (e) => {
        e.preventDefault()
        history.go(-2)
    })
}