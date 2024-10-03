document
  .getElementById("publicationForm")
  .addEventListener("submit", function (e) {
    e.preventDefault(); // Empêche le formulaire de se soumettre de la manière classique

    // Récupérer la valeur du textarea
    var publication = document.getElementById("publication").value;

    // Créer un objet FormData pour envoyer les données
    var formData = new FormData();
    formData.append("publication", publication);

    // Effectuer la requête AJAX
    fetch("../interaction/ajouterPublication.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text()) // Attendre la réponse en texte brut
      .then((data) => {
        // Ajouter la publication à la page
        var lesPublications = document.getElementById("lesPublications");
        lesPublications.innerHTML += data; // Ajouter le HTML renvoyé par le serveur

        // Réinitialiser le textarea
        document.getElementById("publication").value = "";
      })
      .catch((error) => {
        console.error("Erreur:", error);
      });
  });

// pour supprimer une contenue de la publication
function supprimerPublication(publicationId) {
  if (confirm("Êtes-vous sûr de vouloir supprimer cette publication ?")) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../interaction/supprimerPublication.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Supprimer l'élément publication du DOM
        var publicationElement = document.getElementById(
          "publication-" + publicationId
        );
        if (publicationElement) {
          publicationElement.remove();
        }
      }
    };
    xhr.send("publicationId=" + publicationId);
  }
}

// pour modifier une publication
function modifierPublication(publicationId) {
  // Récupérer le contenu actuel de la publication depuis le DOM
  var publicationContent = document.querySelector(
    "#publication-" + publicationId + " .contenuepub p"
  ).textContent;

  // Afficher une boîte de dialogue avec le contenu actuel pour que l'utilisateur puisse le modifier
  var nouveauContenu = prompt(
    "Modifier votre publication :",
    publicationContent
  );

  if (nouveauContenu != null && nouveauContenu.trim() !== "") {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../interaction/modifierPublication.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Mettre à jour le contenu de la publication dans le DOM après modification
        document.querySelector(
          "#publication-" + publicationId + " .contenuepub p"
        ).textContent = nouveauContenu;
      }
    };
    xhr.send(
      "publicationId=" +
        publicationId +
        "&nouveauContenu=" +
        encodeURIComponent(nouveauContenu)
    );
  }
}

// AJAX lorsque l'utilisateur réagit à une publication
function ajouterReaction(publicationId, typeReaction) {
  // Envoi de la requête AJAX
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '../interaction/ajouterReactionPub.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function() {
      if (xhr.status === 200) {
          // Mettre à jour l'interface avec les nouvelles réactions
          const response = JSON.parse(xhr.responseText);

          // Mise à jour des compteurs de réaction
          document.getElementById(`comptlike-${publicationId}`).innerText = response.nbrJaimeP;
          document.getElementById(`comptdislike-${publicationId}`).innerText = response.nbrNonJaimeP;
          document.getElementById(`compthaha-${publicationId}`).innerText = response.nbrHahahaP;
          document.getElementById(`comptlove-${publicationId}`).innerText = response.nbrJadoreP;

          // Activer le bouton correspondant
          document.querySelectorAll('.reaction > button').forEach(button => {
              button.classList.remove('active');
          });
          document.getElementById(`${typeReaction}Button-${publicationId}`).classList.add('active');
      } else {
          console.log('Erreur lors de la mise à jour de la réaction.');
      }
  };

  xhr.send('publicationId=' + publicationId + '&reaction=' + typeReaction);
}
