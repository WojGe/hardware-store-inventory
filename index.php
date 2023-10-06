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
         * This conditional statement eliminates the error performed
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
                                        <td class="p-1"><button class="px-4 py-1 m-1 rounded-lg bg-blue-100 text-blue-600 font-bold hover:bg-blue-600 hover:text-white hover:shadow-lg transition-all">Details</button></td>
                                        <td class="p-1"><?php echo $row['quantity']; ?></td>
                                        <td class="p-1"><button class="px-3 py-1 m-1 rounded-lg bg-red-100 text-red-600 font-bold hover:bg-red-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupIn('DeletePopup');del('<?php echo $row['id'];?>');"><i class="fa fa-trash-o"></i></button></td>
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
                <h1 class="font-bold text-xl">Adding a new device</h1>
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

    <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="DeletePopup">   <!-- Delete device container -->
        <div class="w-96 bg-white p-4 rounded-lg shadow-lg">   <!-- Delete device popup -->
            <div class="p-4 text-center">
                <h1 class="font-bold text-xl">Are you sure?</h1>
            </div>
            <div class="">
                <form method="post">
                    <p id="deleting" class="text-center"></p>
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
     * 
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
     * 
     * These functions sends id of a specified device to the form
     * and set/removes the flag that prevents from the bug that deletes
     * record via any button (cancel or delete).
     * 
     * @param {number} id - ID of the device
     */
    function del(id){
        var deleteId = document.getElementById("deleteId");
        var deleteFlag = document.getElementById("deleteConfirm");
        deleteId.value = id;
        deleteFlag.value = 1;
    }
    function delFlag(){
        var deleteFlag = document.getElementById("deleteConfirm");
        deleteFlag.value = 0;
    }
</script>
</body>
</html>