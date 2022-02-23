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

// Image preview
if (document.getElementById('image')) {
    const img = document.getElementById('image')
    const imgPreview = document.getElementById('image-preview')
    const imgTitle = document.getElementById('image-title')
    img.addEventListener('change', () => {
        const [file] = img.files
        if (file) {
            console.log(file);
            imgPreview.src = URL.createObjectURL(file)
            imgTitle.innerHTML = file.name
        }
    })
}