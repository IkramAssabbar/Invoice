
//import axios from 'axios';
function getServiceInfo2() {
  var selectedService = document.querySelector(".servicee").value;
  if (selectedService) {
      // Effectuez une requête AJAX pour récupérer les informations du service
      var apiUrl ='/services/'+selectedService;

      axios.get(apiUrl)
          .then(function(response) {
              var service = response.data;
console.log(service);
              // Mettez à jour les champs avec les informations du service
              document.getElementById("LibelleService2").value = service.Libelle;
              var idserv=document.getElementById("serviceID").value=service.id;
console.log(idserv);
              //document.getElementById("prixService").value = service.Prix;
              // Mettez à jour d'autres champs selon vos besoins

          })
          .catch(function(error) {
              console.log(error);
          });
  } else {
      // Réinitialisez les champs si aucun service n'est sélectionné
      document.getElementById("prixService").textContent = "";
      // Réinitialisez d'autres champs selon vos besoins
  }
}
document.addEventListener('DOMContentLoaded', function() {
  var modals = document.querySelectorAll('.modal');
  modals.forEach(function(modal) {
    new bootstrap.Modal(modal);
  });
});
;

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
  
   var cmt=0;
   function incrementerCompteur() {
    // Augmenter le compteur de clics
    cmt++;
    
    // Afficher le nombre de clics dans la console
    console.log("Nombre de clics : " + cmt);
  }
  
  function enregisterAdresse()
  {
    
    var Adresse = document.getElementById('Adresseinput').value;
    

    var tableauValeurs =[Adresse];
    
   

    document.getElementsByClassName('adresseValuee')[0].value = tableauValeurs[0];
   
    document.getElementById('adresseValue').textContent = tableauValeurs[0];
    console.log(tableauValeurs);
  }
   //enregister date facture
   function enregistrer() {
    var date = document.getElementById('inputDate').value;
    var echeance = document.getElementById('inputEcheance').value;
    document.getElementById("Echec").textContent='avant le '+echeance;

    var tableauValeurs =[date,echeance];
    document.getElementsByClassName('dateValuee')[0].value = tableauValeurs[0];
    document.getElementById('dateValue').textContent = tableauValeurs[0];

    document.getElementsByClassName('echeanceValuee')[0].value = tableauValeurs[1];
    document.getElementById('echeanceValue').textContent = tableauValeurs[1];

    console.log(tableauValeurs);
   
    
    // Vous pouvez envoyer le tableauValeurs via une requête AJAX ou l'utiliser comme vous le souhaitez
}
   var tableauServices = [];
   var tableauIdsServices = [];
   
  
   function enregistrerService() {
     //document.getElementById("btnEnregistrer").classList.add("hidden");
  
     var prix = document.getElementById('prixService').value;
     var tva = document.getElementById('remiseService').value;
     var description=document.getElementById('description').value;
     var idService=document.getElementById('service_id').value;
     var libelle = document.getElementById("LibelleService").value;
     var categorie=document.getElementById("LibelleCategorie").value;
     //var idBtn=document.getElementById('boutonEnregistrer').onclick
     var ligneService = {
         prix: prix,
         tva: tva,
         description: description,
         idService: idService,
        libelle:libelle,
        categorie:categorie,
       };

       tableauServices.push(ligneService);
       // Créez un nouveau tableau contenant uniquement les ID des services
 tableauIdsServices = tableauServices.map(function(ligneService) {
  return ligneService.idService;
});

console.log(tableauIdsServices);
document.getElementById("tableauIdsServicesInput").value = tableauIdsServices.join(",");


       // Convertir le tableauServices en une chaîne JSON
var servicesJSON = JSON.stringify(tableauServices);
console.log(servicesJSON);

var resultatElement = document.getElementById("resultat");
resultatElement.innerHTML = "";

var i = 0;
var previousLine = null;
// Parcourir le tableau de services
for (i; i < tableauServices.length; i++) {
 // Récupérer les valeurs de chaque objet ligneService
 var ligneService = tableauServices[i];

 var prix = ligneService.prix;
 var remise = ligneService.remise;
 var tva = ligneService.tva;
 var description = ligneService.description;
var libelle=ligneService.libelle;
var categorie=ligneService.categorie;
var isDuplicate = previousLine && 
previousLine.prix === prix &&
previousLine.remise === remise &&
previousLine.tva === tva &&
previousLine.description === description &&
previousLine.libelle===libelle &&
previousLine.categorie===categorie;

// Si la ligne n'est pas un doublon, l'afficher
if (!isDuplicate) {
 // Créer une nouvelle ligne
 var nouvelleLigne = resultatElement.insertRow();

 // Insérer les cellules dans la nouvelle ligne
 var libelleCategorieCell = nouvelleLigne.insertCell();

 var libelleServiceCell = nouvelleLigne.insertCell();
 var prixCell = nouvelleLigne.insertCell();
 var remiseCell = nouvelleLigne.insertCell();
 var tvaCell = nouvelleLigne.insertCell();
 var descriptionCell = nouvelleLigne.insertCell();

 
 libelleServiceCell.textContent=libelle;
 libelleCategorieCell.textContent=categorie;
 prixCell.textContent = prix;
 remiseCell.textContent = remise;
 tvaCell.textContent = tva;
 descriptionCell.textContent = description;
 previousLine = ligneService;
}
}

 
     console.log(tableauServices);
   
     updateTable();
    

     // Vous pouvez envoyer le tableauValeurs via une requête AJAX ou l'utiliser comme vous le souhaitez
    
    // Vous pouvez envoyer le tableauValeurs via une requête AJAX ou l'utiliser comme vous le souhaitez
}
function supprimerDerniereLigne() {
  if (tableauServices.length >= 0) {
    tableauServices.pop();
    console.log(tableauServices);
  }
 
  tableauIdsServices = tableauServices.map(function(ligneService) {
    return ligneService.idService;
  });

  console.log(tableauIdsServices);
  document.getElementById("tableauIdsServicesInput").value = tableauIdsServices.join(",");

  // Mettez à jour l'affichage du tableau après avoir supprimé un service
  updateTable();
  
}
function updateTable() {
  var resultatElement = document.getElementById("resultat");
  resultatElement.innerHTML = "";
  var previousLine = null;

  for (var i = 0; i < tableauServices.length; i++) {
    var ligneService = tableauServices[i];
    var prix = ligneService.prix;
   
    var tva = ligneService.tva;
    var description = ligneService.description;
    var libelle = ligneService.libelle;
    var categorie = ligneService.categorie;
    var isDuplicate =
      previousLine &&
      previousLine.prix === prix &&
    
      previousLine.tva === tva &&
      previousLine.description === description &&
      previousLine.libelle === libelle &&
      previousLine.categorie === categorie;

    if (!isDuplicate) {
      var nouvelleLigne = resultatElement.insertRow();
      var libelleCategorieCell = nouvelleLigne.insertCell();
      var libelleServiceCell = nouvelleLigne.insertCell();
      var prixCell = nouvelleLigne.insertCell();
      var tvaCell = nouvelleLigne.insertCell();
      var descriptionCell = nouvelleLigne.insertCell();

      libelleServiceCell.textContent = libelle;
      libelleCategorieCell.textContent = categorie;
      prixCell.textContent = prix;
      tvaCell.textContent = tva;
      descriptionCell.textContent = description;

      previousLine = ligneService;
    }
  }
}

  function createDropdown(id, defaultText) {
  var selectElement = document.createElement('select');
  selectElement.setAttribute('class', id);
  selectElement.classList.add('mb-3', 'champ-ligne');

  var defaultOption = document.createElement('option');
  defaultOption.setAttribute('disabled', 'disabled');
  defaultOption.setAttribute('selected', 'selected');
  defaultOption.textContent = defaultText;
  selectElement.appendChild(defaultOption);

 $(document).on('change', '#categorie', function () {
  var categorieId = $(this).val();
  var url ='/getServices?IdCategorie='+categorieId;
  console.log(url);
  $('.' + id).html('');
  $.ajax({
    url: url,
    type: 'get',
    success: function (res) {
      $('.' + id).html('<option value="">Select service</option>');
      $.each(res, function (key, value) {
        $('.' + id).append('<option value="' + value.id + '">' + value.Libelle + '</option>');
      console.log(value.Libelle )
      

      
    });
   
    }
    
                    });
                    var selectedOption = this.options[this.selectedIndex];
                     var categoryInfo = JSON.parse(selectedOption.getAttribute('data-info'));

                      // Utilisez les informations de la catégorie sélectionnée comme vous le souhaitez
    console.log(categoryInfo);
        // Vous pouvez mettre à jour d'autres éléments de la vue avec les informations récupérées

        // Exemple de requête AJAX pour obtenir des informations supplémentaires du serveur
        axios.get('/categories/' + categoryInfo.id)
.then(function(response) {
        var additionalInfo = response.data;
        document.getElementById("LibelleCategorie").value=additionalInfo.Nom_Categorie;

        // Utilisez les informations supplémentaires comme vous le souhaitez
        console.log(additionalInfo);
        // Vous pouvez mettre à jour d'autres éléments de la vue avec les informations supplémentaires
    })
    .catch(function(error) {
        console.log(error);
    });
});
$(document).on('change', '.servicee', function () {
   getServiceInfo2();

  });


  return selectElement;
}


  // Fonction pour vérifier si tous les champs sont remplis
  


  
    function generateUniqueId() {
      return 'ligne-' + Math.random().toString(36).substr(2, 9);
    }
  
  function ajouterLignee() {
      var tableBody = document.querySelector('#tableServices tbody');
      var ligneModele = document.querySelector('.ligne-modele');
    
     document.getElementById("btnAjouter").setAttribute("disabled",null);
     
     
    
      // Clonez la ligne de modèle
      var nouvelleLigne = ligneModele.cloneNode(true);
      
      nouvelleLigne.style.display = '';


var serviceElement = nouvelleLigne.querySelector('#service');
serviceElement.parentNode.replaceChild(createDropdown('servicee', 'Select service'), serviceElement);
    
    
      
      var idLigne = generateUniqueId();
    nouvelleLigne.setAttribute('id', idLigne);
  
  //button ajouter
      var boutonEnregistrer = document.createElement('button');
      boutonEnregistrer.classList.add("btn", "btn-success", "btn-sm");
      var iconeEnregistrer = document.createElement('i');
  iconeEnregistrer.classList.add("fas", "fa-check");
  boutonEnregistrer.appendChild(iconeEnregistrer);
   
    boutonEnregistrer.onclick = function() 
    {
      enregistrerLigne(idLigne);
      boutonEnregistrer.setAttribute("disabled", "disabled");
      
    };
  
    var boutonSupprimer = document.createElement('button');
    boutonSupprimer.classList.add("btn", "btn-danger", "btn-sm");
  
    var iconeSupprimer = document.createElement('i');
    iconeSupprimer.classList.add("fas", "fa-trash");
  
    // Ajoutez l'icône à votre bouton
    boutonSupprimer.appendChild(iconeSupprimer);
  
    boutonSupprimer.onclick = function() {
      supprimerLigne(this); // Passer le bouton en tant que référence à la fonction supprimerLigne
    
  };
  
  var celluleBouton = document.createElement('td');
  celluleBouton.appendChild(boutonEnregistrer);
  nouvelleLigne.appendChild(celluleBouton);
    //nouvelleLigne.querySelector('td:last-child').appendChild(boutonEnregistrer);
    nouvelleLigne.querySelector('td:last-child').appendChild(boutonSupprimer);
  
    
      // Ajoutez la nouvelle ligne au corps de la table
      tableBody.appendChild(nouvelleLigne);
    }
  
    function enregistrerLigne(idLigne) {
      var ligne = document.getElementById(idLigne);
  
      document.getElementById("btnAjouter").removeAttribute("disabled");
      
      // Récupérer les valeurs des champs de la ligne
      var prix = ligne.querySelector('.prix-service').value;
      var tva = ligne.querySelector('.remise-service').value;
      var description = ligne.querySelector('.description-service').value;
      var idService = ligne.querySelector('#serviceID').value;
    
      // Créer un objet contenant les valeurs
      var ligneDonnees = {
        prix: prix,
        tva: tva,
        description: description,
        idService: idService
      };
      tableauServices.push(ligneDonnees);
    
      console.log(tableauServices);
      var resultatElement = document.getElementById("resultat");

// Récupérer les éléments des colonnes existantes
var libelleServiceElement = document.getElementById("LibelleService2");
var libelleCategorieElement = document.getElementById("LibelleCategorie");
for (var i = 1; i < tableauServices.length; i++) {
    // Récupérer les valeurs de chaque objet ligneService
    var ligneService = tableauServices[i];
  
    var prix = ligneService.prix;
    var remise = ligneService.remise;
    var tva = ligneService.tva;
    var description = ligneService.description;
  
    // Créer une nouvelle ligne
    var nouvelleLigne = resultatElement.insertRow();
  
    // Insérer les cellules dans la nouvelle ligne
    var libelleCategorieCell = nouvelleLigne.insertCell();
    var libelleServiceCell = nouvelleLigne.insertCell();

    var prixCell = nouvelleLigne.insertCell();
    var remiseCell = nouvelleLigne.insertCell();
    var tvaCell = nouvelleLigne.insertCell();
    var descriptionCell = nouvelleLigne.insertCell();
  
    // Remplir les cellules avec les valeurs
    libelleCategorieCell.appendChild(document.createTextNode(libelleCategorieElement.value));
    libelleServiceCell.appendChild(document.createTextNode(libelleServiceElement.value));
    prixCell.textContent = prix;
    remiseCell.textContent = remise;
    tvaCell.textContent = tva;
    descriptionCell.textContent = description;
  }
      // Ajouter la ligne de données au tableau existant ou faire autre traitement souhaité
    
    }
  
  
  function supprimerLigne(button) {
      var ligne = button.closest('tr');
      var idLigne = ligne.querySelector('.service-id').value;
      
      var index = tableauServices.findIndex(function(ligneDonnees) {
          return ligneDonnees.idService ===  idLigne;
        });
      
        // Suppression de la ligne du tableau
        if (index !== -1) {
          tableauServices.splice(index, 1);
        }
        ligne.remove();
    }
    
  function ajouterLigneversionfausse() {
      var tableBody = document.querySelector('#tableServices tbody');
      
      // Créer une nouvelle ligne
      var newRow = document.createElement('tr');
      
      // Créer les cellules de la ligne
      var cellPrix = document.createElement('td');
      var cellTva = document.createElement('td');
      var cellRemise = document.createElement('td');
      var cellDescription = document.createElement('td');
      var cellActions = document.createElement('td');
      
      // Créer les éléments d'entrée pour chaque cellule
      var inputPrix = document.createElement('input');
      inputPrix.type = 'text';
      inputPrix.placeholder = 'Prix';
      inputPrix.style.width = '60px';
      inputPrix.name = 'Prix';
      inputPrix.id='prixService';
      
      var inputTva = document.createElement('input');
      inputTva.type = 'text';
      inputTva.placeholder = 'TVA';
      inputTva.style.width = '60px';
      inputTva.name = 'Tva';
      
      var inputRemise = document.createElement('input');
      inputRemise.type = 'text';
      inputRemise.placeholder = 'Remise';
      inputRemise.style.width = '60px';
      
      var textareaDescription = document.createElement('textarea');
      textareaDescription.placeholder = 'Description';
      textareaDescription.rows = 2;
      textareaDescription.name = 'Description';
      
      // Ajouter les éléments d'entrée aux cellules correspondantes
      cellPrix.appendChild(inputPrix);
      cellTva.appendChild(inputTva);
      cellRemise.appendChild(inputRemise);
      cellDescription.appendChild(textareaDescription);
      
      // Ajouter les cellules à la ligne
      newRow.appendChild(cellPrix);
      newRow.appendChild(cellTva);
      newRow.appendChild(cellRemise);
      newRow.appendChild(cellDescription);
      
      // Ajouter la ligne au corps de la table
      tableBody.appendChild(newRow);
      enregistrerService();
    }
    
   //modal dedition de facture 
  
  function enregistrerRemise()
  {
  
    var s=0;
    var TVA;
    for (var i = 0; i < tableauServices.length; i++) {
        // Récupérer les valeurs de chaque objet ligneService
        var ligneService = tableauServices[i];
        var prix =parseFloat(ligneService.prix);
         s+=prix;
         TVA =parseFloat(ligneService.tva);

       
    }
  
    var remise = document.getElementById('remisevalue').value;
    //console.log(remise);
    var remiseElement = document.querySelector('.remisevaluee');
    remiseElement.value = remise
    //console.log(remiseElement);
    
    document.getElementById("prcRemise").textContent='Remise globale'+' '+remise+'%';
    var remiseCalcul=s*(remise/100);
    var tvaCalcule=s*(TVA/100);
    document.getElementById("remiselabel").textContent='-'+remiseCalcul+'DH';
    document.getElementById('thva').textContent=s+'DH';
    var MTElement = document.querySelector('.MTValuee');
    MTElement.value = s;
    document.getElementById("labelTVA").textContent='TVA'+' '+TVA+'%';
    var TVAElement = document.querySelector('.TVAValuee');
    TVAElement.value = TVA;
    document.getElementById("tvaCalcule").textContent='-'+tvaCalcule+'DH';
    var echeance = document.getElementById('inputEcheance').value;

    var prixreduitRemise=s-remiseCalcul;
    var prixTotal = prixreduitRemise + (prixreduitRemise * (TVA / 100));
    var prixTotalElement = document.querySelector('.prixtotalValuee');
    prixTotalElement.value = prixTotal;
    document.getElementById("montant").textContent=prixTotal+' '+'DH';
    var alerte=document.getElementById("mt").textContent='Veuillez payez le montant de '+prixTotal+'DH';
  
        console.log("la ligne est "+s);
      
  }

  //verication que tous les champs est remplie avant l'envoie et le telechargement
  function verifierChamps()
  { 
     

    user=document.getElementById('user_id').value;
      dateValue  =  document.getElementById('dateValue').textContent ;
      
      echeanceValue =document.getElementById('echeanceValue').textContent ;
      remiseValue=document.getElementById('remiselabel').textContent ;
      prixTotalValue= document.getElementById('montant').textContent;
     
    
      service=document.getElementById('tableauIdsServicesInput').value;

      if(dateValue!== "" && echeanceValue !== "" && remiseValue !== "" && prixTotalValue !== "" && user !== "" && service!== "")
      {
          document.getElementById('btnEnvoyer').removeAttribute('disabled');
          document.getElementById('btnTelecharger').removeAttribute('disabled');
      
          console.log(user);

      }
      

      else {
  // Désactiver le bouton "Envoyer" si au moins un champ n'est pas rempli
  document.getElementById('btnEnvoyer').setAttribute('disabled', 'disabled');
  document.getElementById('btnTelecharger').setAttribute('disabled', 'disabled');
  console.log('no');
        }
  }
 
  // Observer les changements des champs
var observer = new MutationObserver(verifierChamps);
var options = {
subtree: true,
characterData: true,
childList: true,
};
observer.observe(document.getElementById('dateValue'), options);
observer.observe(document.getElementById('echeanceValue'), options);
observer.observe(document.getElementById('remiselabel'), options);
observer.observe(document.getElementById('montant'), options);
observer.observe(document.getElementById('tableauIdsServicesInput'), options);


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
  
                                  
    