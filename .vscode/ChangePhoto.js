const imgdiv = document.querySelector('pic');
const img =document.querySelector('#photo');
const file = document.querySelector('#upload');
const uploadb =document.querySelector('#uploadlabel');

imgdiv.addEventListener('mouseenter', function(){
    uploadb.style.display="block"
});
uploadb.addEventListener('mouseleave',function(){
uploadb.style.display="none"}
);
uploadb.addEventListener('change',function(){
const choosedfile = this.files[0];
if(choosedfile){
    const reader = new FileReader();
    reader.addEventListener('load', function(){

img.setAttribute('src',reader.result);
    });
    reader.readAsDataURL(choosedfile);
}
});