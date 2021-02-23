const photo = document.querySelector('.photo');
const img = document.querySelector('.photo img');
const icon = document.querySelector('.photo i');

photo.addEventListener('mouseover', function(e){
    photo.style.justifyContent = 'center';
    photo.style.alignItems = 'center';
    img.style.opacity = '0.7';
    photo.style.display = 'flex';
    icon.style.display = 'flex';
    photo.style.backgroundColor = 'black';
})
photo.addEventListener('mouseout', function(e){
    img.style.position = 'relative';
    img.style.opacity = '1';
    icon.style.display = 'none';
    img.style.display = 'flex';
    photo.style.backgroundColor = 'transparent';
})
