<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Crop</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            background-color: whitesmoke;
            font-family: 'Poppins', sans-serif;
        }
        * {
            font-size: 13px;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            line-height: 1.5;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

            
        }
        .card-header {
            color: black;
        }
        .btn-primary {
            width: 100%;
            background:green;
            margin-top: 10px ;
            padding: 10px;
            border:none;

        }
        .btn-primary:hover {
            
            background:greenyellow;

        }
        h4 {
            margin-bottom: 20px;
            font-weight: 600;
            padding-left:8px;
        }
        .card-body{
            padding-right:10px;

        }
    </style>
</head>
<body>
    <div class="container">
       
            
                <center>
                <h4 style=margin-top:20px; >Add New Crop</h4>

                </center>

                <h4>General Information</h4>
  
           
            <div class="card-body">
                <form action="add_crop.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cropName">Crop Name:</label>
                            <input type="text" class="form-control" id="cropName" name="cropName" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cropType">Crop Type:</label>
                            <select class="form-control" id="cropType" name="cropType" required>
                                <option value="" disabled selected>Select crop type</option>
                                <option value="Vegetable">Vegetable</option>
                                <option value="Fruit">Fruit</option>
                                <option value="Grain">Grain</option>
                                <option value="Herb">Herb</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cropDescription">Crop Description:</label>
                            <textarea class="form-control" id="cropDescription" name="cropDescription" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="plantingDate">Planting Date:</label>
                            <input type="date" class="form-control" id="plantingDate" name="plantingDate" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="harvestDate">Expected Harvest Date:</label>
                            <input type="date" class="form-control" id="harvestDate" name="harvestDate" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="soilType">Soil Type:</label>
                            <input type="text" class="form-control" id="soilType" name="soilType" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="waterRequirements">Water Requirements (per week):</label>
                            <input type="text" class="form-control" id="waterRequirements" name="waterRequirements" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fertilizerUsed">Fertilizer Used:</label>
                            <input type="text" class="form-control" id="fertilizerUsed" name="fertilizerUsed" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="seedVariety">Seed Variety:</label>
                            <input type="text" class="form-control" id="seedVariety" name="seedVariety" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="growthDuration">Growth Duration (days):</label>
                            <input type="number" class="form-control" id="growthDuration" name="growthDuration" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="temperatureRequirements">Temperature Requirements:</label>
                            <input type="text" class="form-control" id="temperatureRequirements" name="temperatureRequirements" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="pestControl">Pest Control Measures:</label>
                            <textarea class="form-control" id="pestControl" name="pestControl" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="irrigationMethod">Irrigation Method:</label>
                            <input type="text" class="form-control" id="irrigationMethod" name="irrigationMethod" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="yieldPerAcre">Yield per Acre:</label>
                            <input type="text" class="form-control" id="yieldPerAcre" name="yieldPerAcre" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="plantSpacing">Plant Spacing (in inches):</label>
                            <input type="number" class="form-control" id="plantSpacing" name="plantSpacing" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cropRotation">Crop Rotation Plan:</label>
                            <textarea class="form-control" id="cropRotation" name="cropRotation" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="frostTolerance">Frost Tolerance:</label>
                            <input type="text" class="form-control" id="frostTolerance" name="frostTolerance" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sunlightRequirements">Sunlight Requirements:</label>
                            <input type="text" class="form-control" id="sunlightRequirements" name="sunlightRequirements" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="plantingDepth">Planting Depth (in inches):</label>
                            <input type="number" class="form-control" id="plantingDepth" name="plantingDepth" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="harvestingMethod">Harvesting Method:</label>
                            <input type="text" class="form-control" id="harvestingMethod" name="harvestingMethod" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="storageConditions">Storage Conditions:</label>
                            <input type="text" class="form-control" id="storageConditions" name="storageConditions" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="marketPrice">Market Price (per unit):</label>
                            <input type="number" class="form-control" id="marketPrice" name="marketPrice" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="notes">Notes:</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Crop</button>
                </form>
            </div>
        
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
