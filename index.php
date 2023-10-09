<?php 
    // PHP Add Device Form script
    if(isset($_POST['category']) && isset($_POST['brand']) && isset($_POST['model'])){
        if(!empty($_POST['category']) && !empty($_POST['brand']) && !empty($_POST['model'])){
            $category = $_POST['category'];
            $brand = $_POST['brand'];
            $model = $_POST['model'];
            $quantity = $_POST['quantity'];
            $condition = $_POST['condition'];
            if(empty($_POST['details'])){
                $connection = mysqli_connect('localhost','root','','shop_inventory');
                $sql_add_data = "INSERT INTO devices (id, category, brand, model, quantity, condit) VALUES (NULL, '$category', '$brand', '$model', '$quantity', '$condition')";
                $query_insert = mysqli_query($connection, $sql_add_data);
                $close = mysqli_close($connection);
                header("index.php");
            }else{
                $details = $_POST['details'];
                $connection = mysqli_connect('localhost','root','','shop_inventory');
                $sql_add_data = "INSERT INTO devices (id, category, brand, model, quantity, condit, details) VALUES (NULL, '$category', '$brand', '$model', '$quantity', '$condition', '$details')";
                $query_insert = mysqli_query($connection, $sql_add_data);
                $close = mysqli_close($connection);
                header("index.php");
            };
        };
    };

    // PHP Edit Device Form script
    if(isset($_POST['E_category']) && isset($_POST['E_brand']) && isset($_POST['E_model'])){
        if(!empty($_POST['E_category']) && !empty($_POST['E_brand']) && !empty($_POST['E_model'])){
            $id_update = $_POST['E_id'];
            $category = $_POST['E_category'];
            $brand = $_POST['E_brand'];
            $model = $_POST['E_model'];
            $quantity = $_POST['E_quantity'];
            $condition = $_POST['E_condition'];
            if(empty($_POST['E_details'])){
                $connection = mysqli_connect('localhost','root','','shop_inventory');
                $sql_update_data = "UPDATE devices SET category = '$category', brand = '$brand', model = '$model', quantity = '$quantity', condit = '$condition' WHERE devices.id = '$id_update'";
                $query_insert = mysqli_query($connection, $sql_update_data);
                $close = mysqli_close($connection);
                header("index.php");
            }else{
                $details = $_POST['E_details'];
                $connection = mysqli_connect('localhost','root','','shop_inventory');
                $sql_update = "UPDATE devices SET category = '$category', brand = '$brand', model = '$model', quantity = '$quantity', condit = '$condition', details = '$details' WHERE devices.id = '$id_update'";
                $query_insert = mysqli_query($connection, $sql_update);
                $close = mysqli_close($connection);
                header("index.php");
            };
        };
    };

    // PHP Delete Device Form script
    if(isset($_POST['D_id']) && !empty($_POST['D_id']) && isset($_POST['D_confirm']) && !empty($_POST['D_confirm'])){
        if($_POST['D_confirm']==1){
            $id_detele = $_POST['D_id'];
            $connection = mysqli_connect('localhost','root','','shop_inventory');
            $sql_delete = "DELETE FROM devices WHERE devices.id = '$id_detele';";
            $query = mysqli_query($connection, $sql_delete);
            $close = mysqli_close($connection);
            header("index.php");
        };
    };
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardware store</title>
    <script src="https://cdn.tailwindcss.com"></script>   <!-- Implementing TailwindCSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   <!-- Implementing FontAwesome (font icons) -->
    <script>
        /**
         * 
         * This conditional statement eliminates the bug performed
         * by the PHP code above every time the page is refreshed.
         */
        if(window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-700">
    <div class="pt-10 mx-36">   <!-- Content wrapper -->
        <div class="bg-white p-4 mx-auto rounded-lg shadow-lg">

            <div class="flex">   <!-- Button wrapper -->
                <button class="bg-blue-100 text-blue-600 px-5 p-3 mb-3 ml-auto rounded-lg font-bold hover:bg-blue-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupIn('AddPopup')">Add device</button>
            </div>

            <div class="overflow-auto">   <!-- Table wrapper -->
                <table class="w-full border-x-2 border-gray-200 text-left whitespace-nowrap table-fixed [&>tbody>*:nth-child(odd)]:bg-white [&>tbody>*:nth-child(even)]:bg-gray-100">
                    <thead class="bg-gray-200 border-b-2 border-gray-300">
                        <tr>
                            <th class="w-16 py-3 pr-3 pl-1 font-semibold">ID</th>
                            <th class="w-28 py-3 pr-3 pl-1 font-semibold">Category</th>
                            <th class="w-28 pr-3 PR-3 pl-1 font-semibold">Brand</th>
                            <th class="w-40 py-3 pr-3 pl-1 font-semibold">Model</th>
                            <th class="w-28 py-3 pr-3 pl-1 font-semibold">Show Details</th>
                            <th class="w-20 py-3 pr-3 pl-1 font-semibold">Quantity</th>
                            <th class="w-14 py-3 pr-3 pl-1 font-semibold">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="border-x-2 border-b-2 border-gray-300">
                        <?php
                            $connection = mysqli_connect('localhost','root','','shop_inventory');
                            $sql = "SELECT * FROM devices";
                            $query = mysqli_query($connection, $sql);
                            if(mysqli_num_rows($query)>0){
                                while($row = mysqli_fetch_assoc($query)){?>
                                    <tr>
                                        <td class="p-1 font-bold"><?php echo $row['id']; ?></td>
                                        <td class="p-1 capitalize truncate"><?php echo $row['category']; ?></td>
                                        <td class="p-1 capitalize truncate"><?php echo $row['brand']; ?></td>
                                        <td class="p-1 capitalize truncate"><?php echo $row['model']; ?></td>
                                        <td class="p-1"><button class="px-4 py-1 m-1 rounded-lg bg-blue-100 text-blue-600 font-bold hover:bg-blue-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupIn('DetailsPopup');data('<?php echo $row['id'];?>', '<?php echo $row['category'];?>', '<?php echo $row['brand'];?>', '<?php echo $row['model'];?>', '<?php echo $row['quantity'];?>', '<?php echo $row['condit'];?>', '<?php echo $row['details'];?>');details()">Details</button></td>
                                        <td class="p-1"><?php echo $row['quantity']; ?></td>
                                        <td class="p-1"><button class="px-3 py-1 m-1 rounded-lg bg-red-100 text-red-600 font-bold hover:bg-red-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupIn('DeletePopup');data('<?php echo $row['id'];?>', '<?php echo $row['category'];?>', '<?php echo $row['brand'];?>', '<?php echo $row['model'];?>', '<?php echo $row['quantity'];?>', '<?php echo $row['condit'];?>', '<?php echo $row['details'];?>');del()"><i class="fa fa-trash-o"></i></button></td>
                                    </tr>
                            <?php }
                            }?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="AddPopup">  <!-- Add device container -->
        <div class="w-96 bg-white p-4 rounded-lg shadow-lg">   <!-- Add device popup -->
            <div class="p-4 text-center">
                <h1 class="relative top-4 font-bold text-xl">Adding a new device</h1>
                <div class="relative bottom-12 left-40">
                    <button class="scale-110 px-3 py-1 m-1 rounded-lg text-gray-700 font-bold hover:bg-red-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupOut('AddPopup')"><i class="fa fa-close"></i></button>
                </div>
            </div>
            <div>
                <form method="post">
                    <div class="p-1 m-1">
                        <label for="category">Category:</label><br>
                        <select name="category" class="w-full p-3 border rounded-lg bg-gray-100">
                            <option value="processor">Processors</option>
                            <option value="cooling">Coolings</option>
                            <option value="drives">Drives</option>
                            <option value="graphics card">Graphics Cards</option>
                            <option value="sound card">Sound Cards</option>
                            <option value="pci_controller">PCI Controllers</option>
                            <option value="optical drive">Optical Drives</option>
                            <option value="pc case">PC Cases</option>
                            <option value="ram">RAMs</option>
                            <option value="motherboard">Motherboards</option>
                            <option value="power supply">Power Supplies</option>
                            <option value="monitor">Monitors</option>
                            <option value="mouse">Mouses</option>
                            <option value="mouse pad">Mouse Pads</option>
                            <option value="keyboard">Keyboards</option>
                            <option value="printer">Printers</option>
                            <option value="speakers">Speakers</option>
                            <option value="headphones">Headphones</option>
                            <option value="webcam">Webcams</option>
                            <option value="microphone">Microphones</option>
                            <option value="controller">Controllers</option>
                            <option value="capture card">Capture Cards</option>
                            <option value="laptop">Laptops</option>
                            <option value="tablet">Tablets</option>
                            <option value="software">Software</option>
                            <option value="usb drives">USB Drives</option>
                            <option value="external disk drives">External Disk Drives</option>
                            <option value="printer consumable">Printer Consumables</option>
                            <option value="laptop accessory">Laptop accessories</option>
                            <option value="tablet accessory">Tablet accessories</option>
                            <option value="cable">Cables</option>
                            <option value="ups">UPSs</option>
                            <option value="router">Routers</option>
                            <option value="switch">Switches</option>
                            <option value="nas">NAS Servers</option>
                            <option value="other">Other</option>
                        </select><br>
                    </div>
                    <div class="p-1 m-1">
                        <label for="brand">Brand:</label><br>
                        <input type="text" name="brand" class="w-full p-3 border rounded-lg bg-gray-100" required><br>
                    </div>
                    <div class="p-1 m-1">
                        <label for="model">Model:</label><br>
                        <input type="text" name="model" class="w-full p-3 border rounded-lg bg-gray-100" required><br>
                    </div>
                    <div class="p-1 m-1">
                        <label for="quantity">Quantity:</label><br>
                        <input type="number" name="quantity" class="w-full p-3 border rounded-lg bg-gray-100" min="0" required><br>
                    </div>
                    <div class="p-1 m-1">
                        <label for="condition">Condition:</label><br>
                        <select name="condition" class="w-full p-3 border rounded-lg bg-gray-100">
                            <option value="new">New</option>
                            <option value="refurbished">Refurbished</option>
                            <option value="pre-owned">Pre-Owned</option>
                        </select><br>
                    </div>
                    <div class="p-1 m-1">
                        <label for="details">Additional details:</label><br>
                        <input type="text" name="details" class="w-full p-3 border rounded-lg bg-gray-100"><br>
                    </div>
                    <div class="text-center pt-10 p-1 m-1">
                        <input type="submit" class="w-full bg-blue-100 text-blue-600 p-3 mb-3 rounded-lg font-bold hover:bg-blue-600 hover:text-white hover:shadow-lg transition-all" value="Add device"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="DetailsPopup">  <!-- Details popup -->
        <div class="w-2/3 bg-white p-4 rounded-lg shadow-lg">
            <div class="p-4 text-center">
                <h1 class="relative top-4 font-bold text-xl truncate" id="detailsOf"></h1>
                <div class="relative bottom-12 left-1/2">
                    <button class="scale-110 px-3 py-1 m-1 rounded-lg text-gray-700 font-bold hover:bg-red-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupOut('DetailsPopup')"><i class="fa fa-close"></i></button>
                </div>
            </div>
            <div class="flex flex-row-reverse justify-end lg:justify-between mx-6 lg:mx-10">
                <div class="hidden lg:block flex shrink">
                    <div id="detailsImg">
                            <img width="250px" src="images/placeholder.png" alt="image of the device">
                    </div>
                    
                </div>
                <div class="flex flex-col lg:mr-24 break-all">
                    <p class="py-1 my-1">ID&nbsp;of&nbsp;device: <br><b id="detailsId"></b></p>
                    <p class="py-1 my-1">Category&nbsp;of&nbsp;device: <br><b id="detailsCategory" class="capitalize"></b></p>
                    <p class="py-1 my-1">Device&nbsp;brand: <br><b id="detailsBrand" class="capitalize"></b></p>
                    <p class="py-1 my-1">Device&nbsp;model: <br><b id="detailsModel" class="capitalize"></b></p>
                    <p class="py-1 my-1">Quantity: <br><b id="detailsQuantity"></b></p>
                    <p class="py-1 my-1">Condition: <br><b id="detailsCondit" class="capitalize"></b></p>
                    <p class="py-1 my-1">Additional&nbsp;details: <br><b id="detailsAd"></b></p>
                </div>
            </div>
            <div class="text-center pt-10 p-1 m-1">
                    <button class="w-1/3 bg-blue-100 text-blue-600 p-3 mb-3 rounded-lg font-bold hover:bg-blue-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupIn('EditPopup');PopupOut('DetailsPopup');edit()">Edit device</button>
            </div>
        </div>    
    </div>

    <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="EditPopup">  <!-- Edit device popup -->
        <div class="w-96 bg-white p-4 rounded-lg shadow-lg">
            <div class="p-4 text-center">
                <h1 class="relative top-4 font-bold text-xl truncate" id="editing"></h1>
                <div class="relative bottom-12 left-40">
                    <button class="scale-110 px-3 py-1 m-1 rounded-lg text-gray-700 font-bold hover:bg-red-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupOut('EditPopup')"><i class="fa fa-close"></i></button>
                </div>
            </div>
            <div >
                <form method="post">
                    <input class="hidden" type="number" name="E_id" id="editId">
                    <div class="p-1 m-1">
                        <label for="E_category">Category:</label><br>
                        <select name="E_category" id="editCategory" class="w-full p-3 border rounded-lg bg-gray-100">
                            <option value="processor">Processors</option>
                            <option value="cooling">Coolings</option>
                            <option value="drives">Drives</option>
                            <option value="graphics card">Graphics Cards</option>
                            <option value="sound card">Sound Cards</option>
                            <option value="pci_controller">PCI Controllers</option>
                            <option value="optical drive">Optical Drives</option>
                            <option value="pc case">PC Cases</option>
                            <option value="ram">RAMs</option>
                            <option value="motherboard">Motherboards</option>
                            <option value="power supply">Power Supplies</option>
                            <option value="monitor">Monitors</option>
                            <option value="mouse">Mouses</option>
                            <option value="mouse pad">Mouse Pads</option>
                            <option value="keyboard">Keyboards</option>
                            <option value="printer">Printers</option>
                            <option value="speakers">Speakers</option>
                            <option value="headphones">Headphones</option>
                            <option value="webcam">Webcams</option>
                            <option value="microphone">Microphones</option>
                            <option value="controller">Controllers</option>
                            <option value="capture card">Capture Cards</option>
                            <option value="laptop">Laptops</option>
                            <option value="tablet">Tablets</option>
                            <option value="software">Software</option>
                            <option value="usb drives">USB Drives</option>
                            <option value="external disk drives">External Disk Drives</option>
                            <option value="printer consumable">Printer Consumables</option>
                            <option value="laptop accessory">Laptop accessories</option>
                            <option value="tablet accessory">Tablet accessories</option>
                            <option value="cable">Cables</option>
                            <option value="ups">UPSs</option>
                            <option value="router">Routers</option>
                            <option value="switch">Switches</option>
                            <option value="nas">NAS Servers</option>
                            <option value="other">Other</option>
                        </select><br>
                    </div>
                    <div class="p-1 m-1">
                        <label for="E_brand">Brand: </label><br>
                        <input type="text" name="E_brand" id="editBrand" class="w-full p-3 border rounded-lg bg-gray-100" value="<sp"required><br>
                    </div>
                    <div class="p-1 m-1">
                        <label for="E_model">Model: </label><br>
                        <input type="text" name="E_model" id="editModel" class="w-full p-3 border rounded-lg bg-gray-100" required><br>
                    </div>
                    <div class="p-1 m-1">
                        <label for="E_quantity">Quantity: </label><br>
                        <input type="number" name="E_quantity" id="editQuantity" class="w-full p-3 border rounded-lg bg-gray-100" min="0" required><br>
                    </div>
                    <div class="p-1 m-1">
                        <label for="E_condition">Condition:</label><br>
                        <select name="E_condition" id="editCondition" class="w-full p-3 border rounded-lg bg-gray-100">
                            <option value="new">New</option>
                            <option value="refurbished">Refurbished</option>
                            <option value="pre-owned">Pre-Owned</option>
                        </select><br>
                    </div>
                    <div class="p-1 m-1">
                        <label for="E_details">Additional details: </label><br>
                        <input type="text" name="E_details" id="editDetails" class="w-full p-3 border rounded-lg bg-gray-100"><br>
                    </div>
                    <div class="text-center pt-10 p-1 m-1">
                        <input type="submit" class="w-full bg-blue-100 text-blue-600 p-3 mb-3 rounded-lg font-bold hover:bg-blue-600 hover:text-white hover:shadow-lg transition-all" value="Edit device"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="DeletePopup">   <!-- Delete device container -->
        <div class="w-96 bg-white p-4 rounded-lg shadow-lg">   <!-- Delete device popup -->
            <div class="p-4 text-center">
                <h1 class="font-bold text-xl">Are you sure?</h1>
            </div>
            <div class="">
                <form method="post">
                    <p id="deleting" class="text-center break-all"></p>
                    <div class="text-center pt-10 p-1 m-1">
                        <input class="hidden" type="number" name="D_id" id="deleteId">
                        <input class="hidden" type="number" name="D_confirm" id="deleteConfirm">
                        <button class="w-1/4 text-gray-700 p-3 mb-3 rounded-lg font-bold hover:bg-gray-500 hover:text-white hover:shadow-lg transition-all" onclick="PopupOut('DeletePopup');delFlag()">Cancel</i></button>
                        <input type="submit" class="w-1/4 bg-red-100 text-red-600 p-3 mb-3 rounded-lg font-bold hover:bg-red-600 hover:text-white hover:shadow-lg transition-all" value="Delete"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    /**
     * This function will show a popup window
     * defined by its corresponding id.
     * 
     * @param {string} window - ID of the specified popup window
     */
    function PopupIn(window){
        var PopIn = document.getElementById(window);
        PopIn.classList.remove("hidden");
    }

    /**
     * This function will hide a popup window
     * defined by its corresponding id.
     * 
     * @param {string} window - ID of the specified popup window
     */
    function PopupOut(window){
        var PopOut = document.getElementById(window);
        PopOut.classList.add("hidden");
    }



    /**
     * Global variables (look description below)
     */
    var Gid;
    var Gcategory;
    var Gbrand;
    var Gmodel;
    var Gquantity;
    var Gcondition;
    var Gnotes;

    /**
     * This function transfer information about specific device
     * from the PHP code to global variables in JS to use in other JS functions.
     * 
     * @param {number} id - ID of the device
     * @param {string} category - category of the device
     * @param {string} brand - brand of the device
     * @param {string} model - model of the device
     * @param {number} quantity - quantity of devices
     * @param {string} condition - condition of the device
     * @param {string} details - details about the device
     */
    function data(id, category, brand, model, quantity, condition, details){
        Gid = id;
        Gcategory = category;
        Gbrand = brand;
        Gmodel = model;
        Gquantity = quantity;
        Gcondition = condition;
        Gdetails = details;
    }



    /**
     * This function displays details of specific device
     * from the global variables.
     */
    function details(){
    var header = document.getElementById("detailsOf");
    var detailsId = document.getElementById("detailsId");
    var detailsCategory = document.getElementById("detailsCategory");
    var detailsBrand = document.getElementById("detailsBrand");
    var detailsModel = document.getElementById("detailsModel");
    var detailsQuantity = document.getElementById("detailsQuantity");
    var detailsCondit = document.getElementById("detailsCondit");
    var detailsAd = document.getElementById("detailsAd");
    header.innerHTML = "Details of " + Gbrand + " " + Gmodel;
    detailsId.innerHTML = Gid;
    detailsCategory.innerHTML = Gcategory;
    detailsBrand.innerHTML = Gbrand;
    detailsModel.innerHTML = Gmodel;
    detailsQuantity.innerHTML = Gquantity;
    detailsCondit.innerHTML = Gcondition;
    detailsAd.innerHTML = Gdetails;
    }



    /**
     * This function displays values of the specified device
     * (defined by global variables) in the form.
     */
    function edit(){
    var header = document.getElementById("editing");
    header.innerHTML = "Editing " + Gbrand + " " + Gmodel;
    var editId = document.getElementById("editId");
    var editCategory = document.getElementById("editCategory");
    var editBrand = document.getElementById("editBrand");
    var editModel = document.getElementById("editModel");
    var editQuantity = document.getElementById("editQuantity");
    var editCondit = document.getElementById("editCondition");
    var editDetails = document.getElementById("editDetails");
    editId.value = Gid;
    editCategory.value = Gcategory;
    editBrand.value = Gbrand;
    editModel.value = Gmodel;
    editQuantity.value = Gquantity;
    editCondit.value = Gcondition;
    editDetails.value = Gdetails;
    }



    /**
     * These functions sends id of a specified device to the form,
     * set/removes the flag that prevents from the bug that deletes
     * record via any button (cancel or delete) and asks the user
     * if he/she is sure to delete the record.
     */
    function del(){
        var deleteId = document.getElementById("deleteId");
        var deleteFlag = document.getElementById("deleteConfirm");
        var paragraph = document.getElementById("deleting");
        paragraph.innerHTML = "Are you sure to delete " + Gbrand + " " + Gmodel + " from the database?";
        deleteId.value = Gid;
        deleteFlag.value = 1;
    }
    function delFlag(){
        var deleteFlag = document.getElementById("deleteConfirm");
        deleteFlag.value = 0;
    }
</script>
</body>
</html>