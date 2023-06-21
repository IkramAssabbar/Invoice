
document.getElementById('myModal').addEventListener('click', function() {
  var myModal = new bootstrap.Modal(document.getElementById('myModal'));

});
//2eme modal
document.getElementById('myModale').addEventListener('click', function() {
  var myModale = new bootstrap.Modal(document.getElementById('myModal'));
                                
 });
 //3eme modal du tableau
 document.getElementById('myModaltab').addEventListener('click', function() {
  var myModaltab = new bootstrap.Modal(document.getElementById('myModaltab'));
                               // myModal.show();
 });
 //modal dedition de facture 


const uploadIcon = document.querySelector('.upload-icon');
                                const photoInput = document.querySelector('#photo');
                        
                                uploadIcon.addEventListener('click', function() {
                                    photoInput.click();
                                });
                        
                                photoInput.addEventListener('change', function() {
                                    const selectedPhoto = this.files[0];
                                    if (selectedPhoto) {
                                        // Faites quelque chose avec la photo sélectionnée, comme l'afficher ou l'envoyer au serveur
                                        console.log(selectedPhoto);
                                    }
                                });
                                
  