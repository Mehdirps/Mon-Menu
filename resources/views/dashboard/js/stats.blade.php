
// Fonction pour exporter les données au format PDF en utilisant jsPDF avec jspdf-autotable



// Fonction pour exporter les données au format Excel en utilisant XLSX.js
function exportAllToExcel(catData, prodData, viewData, filename) {
  // Créer un tableau pour les données de l'export Excel
  const exportData = [];

  // Ajouter les en-têtes des catégories
  const catHeaders = ["Catégorie", "Nombre de vues"];
  exportData.push(catHeaders);

  // Ajouter les données des catégories
  catData.forEach(item => {
    exportData.push([item.name, item.seen]);
  });

  // Ajouter une ligne vide entre les catégories et les produits
  exportData.push([]);

  // Ajouter les en-têtes des produits
  const prodHeaders = ["Produit", "Nombre de vues"];
  exportData.push(prodHeaders);

  // Ajouter les données des produits
  prodData.forEach(item => {
    exportData.push([item.name, item.seen]);
  });

  // Ajouter une ligne vide entre les produits et les vues de la semaine
  exportData.push([]);

  // Ajouter les en-têtes des vues de la semaine
  const viewHeaders = ["Date", "Nombre de vues"];
  exportData.push(viewHeaders);

  // Ajouter les données des vues de la semaine

var labels = [
    '{{ Carbon\Carbon::now()->subDays(1)->format("d/m/Y") }}', // Date d'aujourd'hui moins 1 jour
    '{{ Carbon\Carbon::now()->subDays(2)->format("d/m/Y") }}', // Date d'aujourd'hui moins 2 jours
    '{{ Carbon\Carbon::now()->subDays(3)->format("d/m/Y") }}', // Date d'aujourd'hui moins 3 jours
    '{{ Carbon\Carbon::now()->subDays(4)->format("d/m/Y") }}', // Date d'aujourd'hui moins 4 jours
    '{{ Carbon\Carbon::now()->subDays(5)->format("d/m/Y") }}', // Date d'aujourd'hui moins 5 jours
    '{{ Carbon\Carbon::now()->subDays(6)->format("d/m/Y") }}', // Date d'aujourd'hui moins 6 jours
    '{{ Carbon\Carbon::now()->subDays(7)->format("d/m/Y") }}', // Date d'aujourd'hui moins 7 jours
  ];


  viewData.forEach((item, index) => {
    exportData.push([labels[index], item["Nombre de vues"]]);
  });

  // Utiliser XLSX.js pour créer un fichier Excel
  const worksheet = XLSX.utils.aoa_to_sheet(exportData);
  const workbook = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(workbook, worksheet, "Feuille1");
  const excelBuffer = XLSX.write(workbook, { bookType: "xlsx", type: "array" });
  const blob = new Blob([excelBuffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
  const url = URL.createObjectURL(blob);
  const a = document.createElement("a");
  a.href = url;
  a.download = filename + ".xlsx";
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
}





function exportAllToPDF(catData, prodData, viewData, filename) {
  const doc = new jsPDF();

  // Charger le logo depuis le répertoire public de Laravel
  // const logoPath = "logo.png";

  // Récupérer les dimensions du logo
  // const logoWidth = 20;
  // const logoHeight = 13;

  // Ajouter le logo dans l'en-tête du PDF
  // doc.addImage(logoPath, "PNG", 10, 10, logoWidth, logoHeight);

  // Ajouter les informations de votre site dans le pied de page du PDF
  const footerInfo = document.getElementById("footer-info");
  const footerText = footerInfo.innerText;
  const footerMargin = 10;
  const footerWidth = doc.internal.pageSize.width - footerMargin * 2;
  const footerHeight = 20;
  const footerX = footerMargin;
  const footerY = doc.internal.pageSize.height - footerMargin - footerHeight;
  doc.setFontSize(10);
  doc.text(footerText, footerX, footerY, { align: "center", width: footerWidth });

  // Ajouter les informations des catégories dans le PDF
  doc.setFontSize(18);
  doc.text("Catégories les plus vues", 15, 45);
  doc.autoTable({
    head: [["Catégorie", "Nombre de vues"]],
    body: catData.map(item => [item.name, item.seen]),
    startY: 50,
  });



  // Ajouter les informations des produits dans le PDF
  doc.setFontSize(18);
  doc.text("Produits les plus vus", 15, doc.autoTable.previous.finalY + 10);
  doc.autoTable({
    head: [["Produit", "Nombre de vues"]],
    body: prodData.map(item => [item.name, item.seen]),
    startY: doc.autoTable.previous.finalY + 20,
  });

  // Ajouter les informations des vues de la semaine dans le PDF
  doc.setFontSize(18);
  doc.text("Vues de la semaine", 15, doc.autoTable.previous.finalY + 10);


var labels = [
    '{{ Carbon\Carbon::now()->subDays(1)->format("d/m/Y") }}', // Date d'aujourd'hui moins 1 jour
    '{{ Carbon\Carbon::now()->subDays(2)->format("d/m/Y") }}', // Date d'aujourd'hui moins 2 jours
    '{{ Carbon\Carbon::now()->subDays(3)->format("d/m/Y") }}', // Date d'aujourd'hui moins 3 jours
    '{{ Carbon\Carbon::now()->subDays(4)->format("d/m/Y") }}', // Date d'aujourd'hui moins 4 jours
    '{{ Carbon\Carbon::now()->subDays(5)->format("d/m/Y") }}', // Date d'aujourd'hui moins 5 jours
    '{{ Carbon\Carbon::now()->subDays(6)->format("d/m/Y") }}', // Date d'aujourd'hui moins 6 jours
    '{{ Carbon\Carbon::now()->subDays(7)->format("d/m/Y") }}', // Date d'aujourd'hui moins 7 jours
  ];


  // console.log(labels);

  // return ;

  doc.autoTable({
    head: [["Date", "Nombre de vues"]],
    body: viewData.map((item, index) => [labels[index], item["Nombre de vues"]]),
    startY: doc.autoTable.previous.finalY + 20,
  });

  // Générer le PDF
  // doc.save(filename + ".pdf");


  var myImage = new Image();
myImage.src = '{{$url}}logo.png';

myImage.onload = function(){
doc.addImage(myImage , 'png', 15, 20, 20, 13);
doc.save(filename + ".pdf");
};


const pdfDataUri = doc.output('datauristring');

  // Créer l'élément <embed> pour afficher le PDF
  const embedElement = document.createElement('embed');
  embedElement.setAttribute('width', '100%');
  embedElement.setAttribute('height', '600px');
  embedElement.setAttribute('src', pdfDataUri);

  // Récupérer la div cible où tu veux afficher le PDF
  const pdfContainer = document.getElementById('pdf-container'); // Remplace 'pdf-container' par l'ID de ta div cible

  // Vider le contenu précédent de la div (au cas où)
  pdfContainer.innerHTML = '';

  // Ajouter l'élément <embed> dans la div pour afficher le PDF
  pdfContainer.appendChild(embedElement);


}




function exportToPDF(data, filename) {
  const doc = new jsPDF();
  const header = ["Date", "Nombre de vues"];

  // Charger le logo depuis le répertoire public de Laravel


  // Formatage des données pour le PDF
  const rows = data.map(item => [item.Date, item["Nombre de vues"]]);


  // Générer le tableau avec jspdf-autotable
  doc.autoTable({
    head: [header],
    body: rows,
    startY: 40, // Définir la position Y du début du tableau
    didDrawPage: function (data) {
      // Charger le logo dans l'en-tête du PDF
      // doc.addImage(img, "PNG", data.settings.margin.left, 10, 30, 30);

      // doc.addImage(img, "PNG", 15, 40, 180, 180);

      // Ajouter les informations de votre site dans le pied de page du PDF
     const footerInfo = document.getElementById("footer-info");
  const footerText = footerInfo.innerText;
  const footerMargin = 10;
  const footerWidth = doc.internal.pageSize.width - footerMargin * 2;
  const footerHeight = 20;
  const footerX = footerMargin;
  const footerY = doc.internal.pageSize.height - footerMargin - footerHeight;
  doc.setFontSize(10);
  doc.text(footerText, footerX, footerY, { align: "center", width: footerWidth });
    },
  });

  // Générer le PDF
  // doc.save(filename + ".pdf");

  var myImage = new Image();
myImage.src = '{{$url}}logo.png';
myImage.onload = function(){
doc.addImage(myImage , 'png', 15, 20, 20, 13);
doc.save(filename + ".pdf");
};
}


function exportProdToPDF(data, filename) {
  const doc = new jsPDF();
  const header = ["Produit", "Nombre de vues"];

  // Charger le logo depuis le répertoire public de Laravel


  // Formatage des données pour le PDF
  const rows = data.map(item => [item.Produit, item["Nombre de vues"]]);


  // Générer le tableau avec jspdf-autotable
  doc.autoTable({
    head: [header],
    body: rows,
    startY: 40, // Définir la position Y du début du tableau
    didDrawPage: function (data) {
      // Charger le logo dans l'en-tête du PDF
      // doc.addImage(img, "PNG", data.settings.margin.left, 10, 30, 30);

      // doc.addImage(img, "PNG", 15, 40, 180, 180);

      // Ajouter les informations de votre site dans le pied de page du PDF
     const footerInfo = document.getElementById("footer-info");
  const footerText = footerInfo.innerText;
  const footerMargin = 10;
  const footerWidth = doc.internal.pageSize.width - footerMargin * 2;
  const footerHeight = 20;
  const footerX = footerMargin;
  const footerY = doc.internal.pageSize.height - footerMargin - footerHeight;
  doc.setFontSize(10);
  doc.text(footerText, footerX, footerY, { align: "center", width: footerWidth });
    },
  });

  // Générer le PDF
  // doc.save(filename + ".pdf");

  var myImage = new Image();
myImage.src = '{{$url}}logo.png';
myImage.onload = function(){
doc.addImage(myImage , 'png', 15, 20, 20, 13);
doc.save(filename + ".pdf");
};
}


function exportCatToPDF(data, filename) {
  const doc = new jsPDF();
  const header = ["Catégorie", "Nombre de vues"];

  // Charger le logo depuis le répertoire public de Laravel


  // Formatage des données pour le PDF
  const rows = data.map(item => [item.Categorie, item["Nombre de vues"]]);


  // Générer le tableau avec jspdf-autotable
  doc.autoTable({
    head: [header],
    body: rows,
    startY: 40, // Définir la position Y du début du tableau
    didDrawPage: function (data) {
      // Charger le logo dans l'en-tête du PDF
      // doc.addImage(img, "PNG", data.settings.margin.left, 10, 30, 30);

      // doc.addImage(img, "PNG", 15, 40, 180, 180);

      // Ajouter les informations de votre site dans le pied de page du PDF
     const footerInfo = document.getElementById("footer-info");
  const footerText = footerInfo.innerText;
  const footerMargin = 10;
  const footerWidth = doc.internal.pageSize.width - footerMargin * 2;
  const footerHeight = 20;
  const footerX = footerMargin;
  const footerY = doc.internal.pageSize.height - footerMargin - footerHeight;
  doc.setFontSize(10);
  doc.text(footerText, footerX, footerY, { align: "center", width: footerWidth });
    },
  });

  // Générer le PDF
  // doc.save(filename + ".pdf");

  var myImage = new Image();
myImage.src = '{{$url}}logo.png';
myImage.onload = function(){
doc.addImage(myImage , 'png', 15, 20, 20, 13);
doc.save(filename + ".pdf");
};
}


  // Fonction pour exporter les données au format Excel en utilisant SheetJS
  function exportToExcel(data, filename) {
    const worksheet = XLSX.utils.json_to_sheet(data);
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Feuille1");
    const excelBuffer = XLSX.write(workbook, { bookType: "xlsx", type: "array" });
    const blob = new Blob([excelBuffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = filename + ".xlsx";
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
  };

  const urlParams = new URLSearchParams(window.location.search);

  gradientBarChartConfiguration = {
    maintainAspectRatio: false,
    legend: {
      display: false
    },

    tooltips: {
      backgroundColor: '#f5f5f5',
      titleFontColor: '#333',
      bodyFontColor: '#666',
      bodySpacing: 4,
      xPadding: 12,
      mode: "nearest",
      intersect: 0,
      position: "nearest"
    },
    responsive: true,
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: 'rgba(29,140,248,0.1)',
          zeroLineColor: "transparent",
        },
        ticks: {
          autoSkip: true,
          padding: 2,
          fontColor: "#9e9e9e",
          suggestedMin: 20,
          suggestedMax: 20,
        }
      }],

      xAxes: [{

        gridLines: {
          drawBorder: false,
          color: 'rgba(29,140,248,0.1)',
          zeroLineColor: "transparent",
        },
        ticks: {
          padding: 0,
          fontColor: "#9e9e9e",
          fontSize: 9.5,

        }
      }]
    }
  };



  $.ajax({
    url: 'most-viewed-products',
    method: 'GET',
    success: function(response) {
                // Récupérez les données de réponse
                var productsData = response;




                if (urlParams.get("show") === "exportP_PDF") {
                   var pdfData = productsData.map(item => ({
                    "Produit": item.name,
                    "Nombre de vues": item.seen,
                  }));

                  exportProdToPDF(pdfData, "produits_export");
                }

                if (urlParams.get("show") === "exportP") {

                  var excelData = productsData.map(item => ({
                    "Produit": item.name,
                    "Nombre de vues": item.seen,
                  }));

                  exportToExcel(excelData, "produits_export");

                }


                // Créez les tableaux pour les libellés et les données du graphique
                var labels = [];
                var data = [];

                // Parcourez les produits les plus vus et extrayez les noms et les nombres de vues
                for (var i = 0; i < productsData.length; i++) {
                  labels.push(productsData[i].name);
                  data.push(productsData[i].seen);
                }

                // Créez le graphique Chart.js
                var ctx = document.getElementById('chart').getContext('2d');



// chart

var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
    gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors


    var myChart = new Chart(ctx, {
      type: 'bar',
      responsive: true,
      legend: {
        display: false
      },
      data: {
        labels: labels,
        datasets: [{
          label: "Produits les plus vus ",
          fill: true,
          backgroundColor: gradientStroke,
          hoverBackgroundColor: gradientStroke,
          borderColor: '#1f8ef1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          data: data,
        }]
      },
      options: gradientBarChartConfiguration
    });

// chart


},
error: function(xhr, status, error) {
  console.error('Erreur lors de la récupération des produits les plus vus :', error);
}
});



  $.ajax({
    url: 'most-viewed-cats',
    method: 'GET',
    success: function(response) {
                // Récupérez les données de réponse
                var catsData = response;

                // Créez les tableaux pour les libellés et les données du graphique
                var labels = [];
                var data = [];

                // Parcourez les produits les plus vus et extrayez les noms et les nombres de vues
                for (var i = 0; i < catsData.length; i++) {
                  labels.push(catsData[i].name);
                  data.push(catsData[i].seen);
                }






                if (urlParams.get("show") === "exportC_PDF") {

                  var pdfData = catsData.map(item => ({
                    "Categorie": item.name,
                    "Nombre de vues": item.seen,
                  }));

                  exportCatToPDF(pdfData, "categories_export");

                }

                 if (urlParams.get("show") === "exportC") {

                  var excelData = catsData.map(item => ({
                    "Catégorie": item.name,
                    "Nombre de vues": item.seen,
                  }));

                  exportToExcel(excelData, "categories_export");

                }





                var ctx = document.getElementById("chart-cats").getContext("2d");

                var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

                gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
                gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
    gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors


    var myChart = new Chart(ctx, {
      type: 'bar',
      responsive: true,
      legend: {
        display: false
      },
      data: {
        labels: labels,
        datasets: [{
          label: "Catégories les plus vues ",
          fill: true,
          backgroundColor: gradientStroke,
          hoverBackgroundColor: gradientStroke,
          borderColor: '#1f8ef1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          data: data,
        }]
      },
      options: gradientBarChartConfiguration
    });

  },
  error: function(xhr, status, error) {
    console.error('Erreur lors de la récupération des catégorie les plus vus :', error);
  }
});


  var viewStatsHier = {!! json_encode($viewStatsHier) !!};
  var viewavanthier = {!! json_encode($viewavanthier) !!};
  var viewilyatoisj = {!! json_encode($viewilyatoisj) !!};
  var viewilyaquatrej = {!! json_encode($viewilyaquatrej) !!};
  var viewilyacinqj = {!! json_encode($viewilyacinqj) !!};
  var viewilyasixj = {!! json_encode($viewilyasixj) !!};
  var ilyaseptj = {!! json_encode($ilyaseptj) !!};

// Create arrays for the labels and data of the chart
var labels = ['hier', 'il y a 2j', '3 j', '4 j', '5 j', '6 j', '7 j'];
var data = [
{{ $viewStatsHier[0]->views ?? 0 }},
{{ $viewavanthier[0]->views ?? 0 }},
{{ $viewilyatoisj[0]->views ?? 0 }},
{{ $viewilyaquatrej[0]->views ?? 0 }},
{{ $viewilyacinqj[0]->views ?? 0 }},
{{ $viewilyasixj[0]->views ?? 0 }},
{{ $ilyaseptj[0]->views ?? 0 }}
];

console.log('viewStatsHier', viewStatsHier );

var totalviews = viewStatsHier[0].views + viewavanthier[0].views + viewilyatoisj[0].views + viewilyaquatrej[0].views + viewilyacinqj[0].views + viewilyasixj[0].views + ilyaseptj[0].views ;

$('.nbrs_vues h3').html('Nombre de vues de la semaine : <b> '+totalviews+' </b> ');



  if (urlParams.get("show") === "exportS_PDF") {



var labels = [
    '{{ Carbon\Carbon::now()->subDays(1)->format("d/m/Y") }}', // Date d'aujourd'hui moins 1 jour
    '{{ Carbon\Carbon::now()->subDays(2)->format("d/m/Y") }}', // Date d'aujourd'hui moins 2 jours
    '{{ Carbon\Carbon::now()->subDays(3)->format("d/m/Y") }}', // Date d'aujourd'hui moins 3 jours
    '{{ Carbon\Carbon::now()->subDays(4)->format("d/m/Y") }}', // Date d'aujourd'hui moins 4 jours
    '{{ Carbon\Carbon::now()->subDays(5)->format("d/m/Y") }}', // Date d'aujourd'hui moins 5 jours
    '{{ Carbon\Carbon::now()->subDays(6)->format("d/m/Y") }}', // Date d'aujourd'hui moins 6 jours
    '{{ Carbon\Carbon::now()->subDays(7)->format("d/m/Y") }}', // Date d'aujourd'hui moins 7 jours
  ];

      var pdfData = labels.map((date, index) => ({
      "Date": date,
      "Nombre de vues": data[index], // Utilisez les données pour les vues de la semaine
    }));


exportToPDF(pdfData,'export_semaine');



}


  if (urlParams.get("show") === "exportS") {


     var labels = [
    '{{ Carbon\Carbon::now()->subDays(1)->format("d/m/Y") }}', // Date d'aujourd'hui moins 1 jour
    '{{ Carbon\Carbon::now()->subDays(2)->format("d/m/Y") }}', // Date d'aujourd'hui moins 2 jours
    '{{ Carbon\Carbon::now()->subDays(3)->format("d/m/Y") }}', // Date d'aujourd'hui moins 3 jours
    '{{ Carbon\Carbon::now()->subDays(4)->format("d/m/Y") }}', // Date d'aujourd'hui moins 4 jours
    '{{ Carbon\Carbon::now()->subDays(5)->format("d/m/Y") }}', // Date d'aujourd'hui moins 5 jours
    '{{ Carbon\Carbon::now()->subDays(6)->format("d/m/Y") }}', // Date d'aujourd'hui moins 6 jours
    '{{ Carbon\Carbon::now()->subDays(7)->format("d/m/Y") }}', // Date d'aujourd'hui moins 7 jours
  ];

                  var excelData = labels.map((date, index) => ({
      "Date": date,
      "Nombre de vues": data[index], // Utilisez les données pour les vues de la semaine
    }));

                  exportToExcel(excelData, "semaine_export");

                }


// Get the canvas context where the chart will be rendered
var ct = document.getElementById("filter").getContext("2d");

// Create a gradient for the chart's background
var gradientStroke = ct.createLinearGradient(0, 230, 0, 50);
gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); // blue colors

// Create the chart using Chart.js
var myChart = new Chart(ct, {
  type: 'bar',
  responsive: true,
  legend: {
    display: false
  },
  data: {
    labels: labels,
    datasets: [{
      label: "Nombre de vues",
      fill: true,
      backgroundColor: gradientStroke,
      hoverBackgroundColor: gradientStroke,
      borderColor: '#1f8ef1',
      borderWidth: 2,
      borderDash: [],
      borderDashOffset: 0.0,
      data: data,
    }]
  },
  options: gradientBarChartConfiguration // This variable must be defined somewhere else in the code.
});


<?php if (isset($_GET['exportAllToPDF'])) : ?>


$.ajax({
      url: 'most-viewed-cats', // Remplacez par l'URL réelle pour les catégories
      method: 'GET',
      success: function(categoriesData) {
        var categories = categoriesData;
        // Requête AJAX pour récupérer les données des produits
        $.ajax({
          url: 'most-viewed-products', // Remplacez par l'URL réelle pour les produits
          method: 'GET',
          success: function(productsData) {
            // Définir les données des vues de la semaine
            var products = productsData;

            var viewStatsHier = {!! json_encode($viewStatsHier) !!};
            var viewavanthier = {!! json_encode($viewavanthier) !!};
            var viewilyatoisj = {!! json_encode($viewilyatoisj) !!};
            var viewilyaquatrej = {!! json_encode($viewilyaquatrej) !!};
            var viewilyacinqj = {!! json_encode($viewilyacinqj) !!};
            var viewilyasixj = {!! json_encode($viewilyasixj) !!};
            var ilyaseptj = {!! json_encode($ilyaseptj) !!};

            var weekViewData = [
              viewStatsHier[0].views,
              viewavanthier[0].views,
              viewilyatoisj[0].views,
              viewilyaquatrej[0].views,
              viewilyacinqj[0].views,
              viewilyasixj[0].views,
              ilyaseptj[0].views
            ];

            var labels = [
    '{{ Carbon\Carbon::now()->subDays(1)->format("d/m/Y") }}', // Date d'aujourd'hui moins 1 jour
    '{{ Carbon\Carbon::now()->subDays(2)->format("d/m/Y") }}', // Date d'aujourd'hui moins 2 jours
    '{{ Carbon\Carbon::now()->subDays(3)->format("d/m/Y") }}', // Date d'aujourd'hui moins 3 jours
    '{{ Carbon\Carbon::now()->subDays(4)->format("d/m/Y") }}', // Date d'aujourd'hui moins 4 jours
    '{{ Carbon\Carbon::now()->subDays(5)->format("d/m/Y") }}', // Date d'aujourd'hui moins 5 jours
    '{{ Carbon\Carbon::now()->subDays(6)->format("d/m/Y") }}', // Date d'aujourd'hui moins 6 jours
    '{{ Carbon\Carbon::now()->subDays(7)->format("d/m/Y") }}', // Date d'aujourd'hui moins 7 jours
  ];




      var weekViewDataMap = labels.map((date, index) => ({
      "Date": 'test',
      "Nombre de vues": weekViewData[index], // Utilisez les données pour les vues de la semaine
    }));

             console.log(labels);

            // Appelez la fonction exportAllToPDF avec les données appropriées
            exportAllToPDF(categories, products, weekViewDataMap, "export_all_data");
          },
          error: function(xhr, status, error) {
            console.error('Erreur lors de la récupération des produits :', error);
          }
        });
      },
      error: function(xhr, status, error) {
        console.error('Erreur lors de la récupération des catégories :', error);
      },
      complete: function() {
       //  window.location = "./admin";
      }
    });



 <?php endif; ?>




<?php if (isset($_GET['exportAllToExcel'])) : ?>


$.ajax({
      url: 'most-viewed-cats', // Remplacez par l'URL réelle pour les catégories
      method: 'GET',
      success: function(categoriesData) {
        var categories = categoriesData;
        // Requête AJAX pour récupérer les données des produits
        $.ajax({
          url: 'most-viewed-products', // Remplacez par l'URL réelle pour les produits
          method: 'GET',
          success: function(productsData) {
            // Définir les données des vues de la semaine
            var products = productsData;

            var viewStatsHier = {!! json_encode($viewStatsHier) !!};
            var viewavanthier = {!! json_encode($viewavanthier) !!};
            var viewilyatoisj = {!! json_encode($viewilyatoisj) !!};
            var viewilyaquatrej = {!! json_encode($viewilyaquatrej) !!};
            var viewilyacinqj = {!! json_encode($viewilyacinqj) !!};
            var viewilyasixj = {!! json_encode($viewilyasixj) !!};
            var ilyaseptj = {!! json_encode($ilyaseptj) !!};

            var weekViewData = [
              viewStatsHier[0].views,
              viewavanthier[0].views,
              viewilyatoisj[0].views,
              viewilyaquatrej[0].views,
              viewilyacinqj[0].views,
              viewilyasixj[0].views,
              ilyaseptj[0].views
            ];

            var labels = [
    '{{ Carbon\Carbon::now()->subDays(1)->format("d/m/Y") }}', // Date d'aujourd'hui moins 1 jour
    '{{ Carbon\Carbon::now()->subDays(2)->format("d/m/Y") }}', // Date d'aujourd'hui moins 2 jours
    '{{ Carbon\Carbon::now()->subDays(3)->format("d/m/Y") }}', // Date d'aujourd'hui moins 3 jours
    '{{ Carbon\Carbon::now()->subDays(4)->format("d/m/Y") }}', // Date d'aujourd'hui moins 4 jours
    '{{ Carbon\Carbon::now()->subDays(5)->format("d/m/Y") }}', // Date d'aujourd'hui moins 5 jours
    '{{ Carbon\Carbon::now()->subDays(6)->format("d/m/Y") }}', // Date d'aujourd'hui moins 6 jours
    '{{ Carbon\Carbon::now()->subDays(7)->format("d/m/Y") }}', // Date d'aujourd'hui moins 7 jours
  ];




      var weekViewDataMap = labels.map((date, index) => ({
      "Date": 'test',
      "Nombre de vues": weekViewData[index], // Utilisez les données pour les vues de la semaine
    }));

             console.log(labels);

            // Appelez la fonction exportAllToPDF avec les données appropriées
            exportAllToExcel(categories, products, weekViewDataMap, "export_all_data");
          },
          error: function(xhr, status, error) {
            console.error('Erreur lors de la récupération des produits :', error);
          }
        });
      },
      error: function(xhr, status, error) {
        console.error('Erreur lors de la récupération des catégories :', error);
      },
      complete: function() {
       //  window.location = "./admin";
      }
    });



 <?php endif; ?>





$("#exportAllToPDFButton").on("click", function() {
    // Requête AJAX pour récupérer les données des catégories
    $.ajax({
      url: 'most-viewed-cats', // Remplacez par l'URL réelle pour les catégories
      method: 'GET',
      success: function(categoriesData) {
        var categories = categoriesData;
        // Requête AJAX pour récupérer les données des produits
        $.ajax({
          url: 'most-viewed-products', // Remplacez par l'URL réelle pour les produits
          method: 'GET',
          success: function(productsData) {
            // Définir les données des vues de la semaine
            var products = productsData;

            var viewStatsHier = {!! json_encode($viewStatsHier) !!};
            var viewavanthier = {!! json_encode($viewavanthier) !!};
            var viewilyatoisj = {!! json_encode($viewilyatoisj) !!};
            var viewilyaquatrej = {!! json_encode($viewilyaquatrej) !!};
            var viewilyacinqj = {!! json_encode($viewilyacinqj) !!};
            var viewilyasixj = {!! json_encode($viewilyasixj) !!};
            var ilyaseptj = {!! json_encode($ilyaseptj) !!};

            var weekViewData = [
              viewStatsHier[0].views,
              viewavanthier[0].views,
              viewilyatoisj[0].views,
              viewilyaquatrej[0].views,
              viewilyacinqj[0].views,
              viewilyasixj[0].views,
              ilyaseptj[0].views
            ];

            var labels = [
    '{{ Carbon\Carbon::now()->subDays(1)->format("d/m/Y") }}', // Date d'aujourd'hui moins 1 jour
    '{{ Carbon\Carbon::now()->subDays(2)->format("d/m/Y") }}', // Date d'aujourd'hui moins 2 jours
    '{{ Carbon\Carbon::now()->subDays(3)->format("d/m/Y") }}', // Date d'aujourd'hui moins 3 jours
    '{{ Carbon\Carbon::now()->subDays(4)->format("d/m/Y") }}', // Date d'aujourd'hui moins 4 jours
    '{{ Carbon\Carbon::now()->subDays(5)->format("d/m/Y") }}', // Date d'aujourd'hui moins 5 jours
    '{{ Carbon\Carbon::now()->subDays(6)->format("d/m/Y") }}', // Date d'aujourd'hui moins 6 jours
    '{{ Carbon\Carbon::now()->subDays(7)->format("d/m/Y") }}', // Date d'aujourd'hui moins 7 jours
  ];

      var weekViewDataMap = labels.map((date, index) => ({
      "Date": date,
      "Nombre de vues": weekViewData[index], // Utilisez les données pour les vues de la semaine
    }));

            // Appelez la fonction exportAllToPDF avec les données appropriées
            exportAllToPDF(categories, products, weekViewDataMap, "export_all_data");
          },
          error: function(xhr, status, error) {
            console.error('Erreur lors de la récupération des produits :', error);
          }
        });
      },
      error: function(xhr, status, error) {
        console.error('Erreur lors de la récupération des catégories :', error);
      }
    });
  });


