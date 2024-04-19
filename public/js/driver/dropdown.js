<script>
function populateModels() {
    var brandSelect = document.getElementById("make");
    var modelSelect = document.getElementById("model");
    var selectedBrand = brandSelect.value;
    // Clear existing options
    modelSelect.innerHTML = "<option value=''>Select Model</option>";
    if (selectedBrand === "") {
        // If no brand is selected, leave model dropdown empty
        return;
    }
    // Add options based on selected brand
    var models = getModelOptions(selectedBrand);
    models.forEach(function(model) {
        var option = document.createElement("option");
        option.text = model;
        option.value = model;
        modelSelect.appendChild(option);
    });
}

function getModelOptions(brand) {
    // Here you can provide model options for each brand available in Sri Lanka
    switch (brand) {
        case "Acura":
            return ["MDX", "RDX", "TLX"];
        case "Alfa Romeo":
            return ["Giulia", "Stelvio"];
        case "Aprilia":
            return ["RSV4", "Tuono", "RS 660"];
        case "Audi":
            return ["A3", "A4", "Q5"];
        case "Austin":
            return ["Mini", "1300"];
        case "BMW":
            return ["3 Series", "5 Series", "X1", "X3", "X5"];
        case "Chery":
            return ["Arrizo 5", "Tiggo 7"];
        case "Chevrolet":
            return ["Cruze", "Spark", "Trailblazer"];
        case "Citroen":
            return ["C3", "C5 Aircross"];
        case "Daewoo":
            return ["Lanos", "Matiz"];
        case "Daihatsu":
            return ["Mira", "Terios"];
        case "DEF":
            return ["DEF Model1", "DEF Model2"];
        case "Dimo":
            return ["Batta", "L300"];
        case "Dsk Benelli":
            return ["TNT 300", "TNT 600i"];
        case "Ducati":
            return ["Panigale V4", "Monster 821"];
        case "Fiat":
            return ["500", "Punto"];
        case "Ford":
            return ["Fiesta", "Focus", "Ranger"];
        case "Foton":
            return ["View", "Thunder"];
        case "Harley Davidson":
            return ["Street Glide", "Iron 883"];
        case "Honda":
            return ["Civic", "City", "CR-V"];
        case "Hyundai":
            return ["i10", "i20", "Tucson"];
        case "Isuzu":
            return ["D-Max", "MU-X"];
        case "Jaguar":
            return ["XE", "F-Pace"];
        case "Jeep":
            return ["Wrangler", "Cherokee"];
        case "KIA":
            return ["Rio", "Seltos", "Sportage"];
        case "Mazda":
            return ["3", "CX-5"];
        case "Mercedes-Benz":
            return ["C-Class", "E-Class", "GLA", "GLC", "GLE"];
        case "Mitsubishi":
            return ["Lancer", "Outlander", "Pajero", "Mirage", "Montero"];
        case "Nissan":
            return ["Sunny", "March", "X-Trail", "Leaf", "Navara"];
        case "Perodua":
            return ["Axia", "Myvi"];
        case "Suzuki":
            return ["Alto", "Swift", "Wagon R", "Baleno", "Vitara"];
        case "Toyota":
            return ["Corolla", "Yaris", "Vitz", "Prius", "Hiace"];
        case "Land Rover":
            return ["Range Rover", "Discovery"];
        case "Micro":
            return ["Panda Cross", "Rhino"];
        default:
            return []; // If brand not found or no models available
    }
}
</script>