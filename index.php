<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardware store</title>
    <script src="https://cdn.tailwindcss.com"></script>   <!-- Implementing TailwindCSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   <!-- Implementing FontAwesome (font icons) -->
</head>
<body class="bg-gray-100 text-gray-700 transition-all">
    <?php
        if($_SESSION){
            if($_SESSION['alert_type'] == 0){   // Success Alert
                ?>
                <section class="alert fixed right-2 bottom-2" id="SuccessAlert">   
                    <div class="text-green-600 bg-green-100 hover:text-white hover:bg-green-600 rounded-lg transition-all flex justify-between shadow-lg p-3">
                        <p class="self-center"><i class="scale-150 px-2 fa fa-check-circle"></i></p>
                        <p class="self-center px-5"><?php echo $_SESSION['alert']; ?></p>
                        <button class="px-3 py-1 m-1 font-bold hover:text-green-900 transition-all" onclick="PopupOut('SuccessAlert')"><i class="fa fa-close"></i></button>
                    </div>
                </section>
                <?php
            };
            if($_SESSION['alert_type'] == 1){   // Warning Alert
                ?>
                <section class="alert fixed right-2 bottom-2" id="WarningAlert">
                    <div class="text-amber-600 bg-amber-100 hover:text-white hover:bg-amber-600 rounded-lg transition-all flex justify-between shadow-lg p-3">
                        <p class="self-center"><i class="scale-150 px-2 fa fa-exclamation-circle"></i></p>
                        <p class="self-center px-5"><?php echo $_SESSION['alert']; ?></p>
                        <button class="px-3 py-1 m-1 font-bold hover:text-amber-900 transition-all" onclick="PopupOut('WarningAlert')"><i class="fa fa-close"></i></button>
                    </div>
                </section>
                <?php
            };
            if($_SESSION['alert_type'] == 2){   // Error Alert
                ?>
                <section class="alert fixed right-2 bottom-2" id="ErrorAlert">
                    <div class="text-red-600 bg-red-100 hover:text-white hover:bg-red-600 rounded-lg transition-all flex justify-between shadow-lg p-3">
                        <p class="self-center"><i class="scale-150 px-2 fa fa-times-circle"></i></p>
                        <p class="self-center px-5"><?php echo $_SESSION['alert']; ?></p>
                        <button class="px-3 py-1 m-1 font-bold hover:text-red-900 transition-all" onclick="PopupOut('ErrorAlert')"><i class="fa fa-close"></i></button>
                    </div>
                </section>
                <?php
            };
        };
        session_destroy();
    ?>
    <section class="py-16 mx-36">   <!-- Content wrapper -->
        <div class="bg-white p-4 mx-auto rounded-lg shadow-lg">

            <nav class="flex">   <!-- Button wrapper -->
                <button class="bg-blue-100 text-blue-600 px-5 p-3 mb-3 ml-auto rounded-lg font-bold hover:bg-blue-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupIn('AddPopup')">Add device</button>
            </nav>

            <main class="overflow-auto">   <!-- Table wrapper -->
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
                                        <td class="p-1"><button class="px-4 py-1 m-1 rounded-lg bg-blue-100 text-blue-600 font-bold hover:bg-blue-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupIn('DetailsPopup');data('<?php echo $row['id'];?>', '<?php echo $row['category'];?>', '<?php echo $row['brand'];?>', '<?php echo $row['model'];?>', '<?php echo $row['quantity'];?>', '<?php echo $row['condit'];?>', '<?php echo $row['details'];?>', '<?php echo $row['img'];?>');details()">Details</button></td>
                                        <td class="p-1"><?php echo $row['quantity']; ?></td>
                                        <td class="p-1"><button class="px-3 py-1 m-1 rounded-lg bg-red-100 text-red-600 font-bold hover:bg-red-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupIn('DeletePopup');data('<?php echo $row['id'];?>', '<?php echo $row['category'];?>', '<?php echo $row['brand'];?>', '<?php echo $row['model'];?>', '<?php echo $row['quantity'];?>', '<?php echo $row['condit'];?>', '<?php echo $row['details'];?>', '<?php echo $row['img'];?>');del()"><i class="fa fa-trash-o"></i></button></td>
                                    </tr>
                            <?php }
                            }?>
                    </tbody>
                </table>
            </main>
        </div>
    </section>

    <section class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="AddPopup">  <!-- Add device container -->
        <div class="w-96 bg-white p-4 rounded-lg shadow-lg">   <!-- Add device popup -->
            <header class="p-4 text-center">
                <h1 class="relative top-4 font-bold text-xl">Adding a new device</h1>
                <nav class="relative bottom-12 left-40">
                    <button class="scale-110 px-3 py-1 m-1 rounded-lg text-gray-700 font-bold hover:bg-red-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupOut('AddPopup')"><i class="fa fa-close"></i></button>
                </nav>
            </header>
            <main>
                <form method="post" action="add.php" enctype="multipart/form-data">
                    <div class="p-1 m-1">
                        <label for="category">Category:</label>
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
                        </select>
                    </div>
                    <div class="p-1 m-1">
                        <label for="brand">Brand:</label>
                        <input type="text" name="brand" class="w-full p-3 border rounded-lg bg-gray-100" required>
                    </div>
                    <div class="p-1 m-1">
                        <label for="model">Model:</label>
                        <input type="text" name="model" class="w-full p-3 border rounded-lg bg-gray-100" required>
                    </div>
                    <div class="p-1 m-1">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" class="w-full p-3 border rounded-lg bg-gray-100" min="0" required>
                    </div>
                    <div class="p-1 m-1">
                        <label for="condition">Condition:</label>
                        <select name="condition" class="w-full p-3 border rounded-lg bg-gray-100">
                            <option value="new">New</option>
                            <option value="refurbished">Refurbished</option>
                            <option value="pre-owned">Pre-Owned</option>
                        </select>
                    </div>
                    <div class="p-1 m-1">
                    <label for="image">Image of the device:</label>
                        <input type="file" name="image" class="w-full p-3" accept=".jpg, .jpeg, .png">
                    </div>
                    <div class="p-1 m-1">
                        <label for="details">Additional details:</label>
                        <input type="text" name="details" class="w-full p-3 border rounded-lg bg-gray-100">
                    </div>
                    <div class="text-center pt-10 p-1 m-1">
                        <input type="submit" class="w-full bg-blue-100 text-blue-600 p-3 mb-3 rounded-lg font-bold hover:bg-blue-600 hover:text-white hover:shadow-lg transition-all" value="Add device"></input>
                    </div>
                </form>
            </main>
        </div>
    </section>

    <section class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="DetailsPopup">  <!-- Details popup -->
        <div class="w-2/3 bg-white p-4 rounded-lg shadow-lg">
            <header class="p-4 text-center">
                <h1 class="relative top-4 font-bold text-xl truncate" id="detailsOf"></h1>
                <nav class="relative bottom-12 left-1/2">
                    <button class="scale-110 px-3 py-1 m-1 rounded-lg text-gray-700 font-bold hover:bg-red-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupOut('DetailsPopup')"><i class="fa fa-close"></i></button>
                </nav>
            </header>
            <main class="flex flex-row-reverse justify-end lg:justify-between mx-6 lg:mx-10">
                <figure class="hidden lg:block">
                    <img width="320px" src="" alt="" id="detailsImage" class="p-3 shadow-lg">
                </figure>
                <section class="flex flex-col lg:mr-24 break-all">
                    <p class="py-1 my-1">ID&nbsp;of&nbsp;device: <br><b id="detailsId"></b></p>
                    <p class="py-1 my-1">Category&nbsp;of&nbsp;device: <br><b id="detailsCategory" class="capitalize"></b></p>
                    <p class="py-1 my-1">Device&nbsp;brand: <br><b id="detailsBrand" class="capitalize"></b></p>
                    <p class="py-1 my-1">Device&nbsp;model: <br><b id="detailsModel" class="capitalize"></b></p>
                    <p class="py-1 my-1">Quantity: <br><b id="detailsQuantity"></b></p>
                    <p class="py-1 my-1">Condition: <br><b id="detailsCondit" class="capitalize"></b></p>
                    <p class="py-1 my-1">Additional&nbsp;details: <br><b id="detailsAd"></b></p>
                </section>
            </main>
            <footer class="text-center pt-10 p-1 m-1">
                    <button class="w-1/3 bg-blue-100 text-blue-600 p-3 mb-3 rounded-lg font-bold hover:bg-blue-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupIn('EditPopup');edit()">Edit device</button>
            </footer>
        </div>    
    </section>

    <section class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="EditPopup">  <!-- Edit device popup -->
        <div class="w-96 bg-white p-4 rounded-lg shadow-lg">
            <header class="p-4 text-center">
                <h1 class="relative top-4 font-bold text-xl truncate" id="editing"></h1>
                <nav class="relative bottom-12 left-40">
                    <button class="scale-110 px-3 py-1 m-1 rounded-lg text-gray-700 font-bold hover:bg-red-600 hover:text-white hover:shadow-lg transition-all" onclick="PopupOut('EditPopup')"><i class="fa fa-close"></i></button>
                </nav>
            </header>
            <main>
            <form method="post" action="edit.php" enctype="multipart/form-data">
                    <input class="hidden" type="number" name="E_id" id="editId">
                    <div class="p-1 m-1">
                        <label for="E_category">Category:</label>
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
                        </select>
                    </div>
                    <div class="p-1 m-1">
                        <label for="E_brand">Brand: </label>
                        <input type="text" name="E_brand" id="editBrand" class="w-full p-3 border rounded-lg bg-gray-100" value="<sp"required>
                    </div>
                    <div class="p-1 m-1">
                        <label for="E_model">Model: </label>
                        <input type="text" name="E_model" id="editModel" class="w-full p-3 border rounded-lg bg-gray-100" required>
                    </div>
                    <div class="p-1 m-1">
                        <label for="E_quantity">Quantity: </label>
                        <input type="number" name="E_quantity" id="editQuantity" class="w-full p-3 border rounded-lg bg-gray-100" min="0" required>
                    </div>
                    <div class="p-1 m-1">
                        <label for="E_condition">Condition:</label>
                        <select name="E_condition" id="editCondition" class="w-full p-3 border rounded-lg bg-gray-100">
                            <option value="new">New</option>
                            <option value="refurbished">Refurbished</option>
                            <option value="pre-owned">Pre-Owned</option>
                        </select>
                    </div>
                    <div class="p-1 m-1">
                    <label for="image">New image:</label>
                        <input type="file" name="E_image" class="w-full p-3" accept=".jpg, .jpeg, .png">
                    </div>
                    <div class="p-1 m-1">
                        <label for="E_details">Additional details: </label>
                        <input type="text" name="E_details" id="editDetails" class="w-full p-3 border rounded-lg bg-gray-100">
                    </div>
                    <div class="text-center pt-10 p-1 m-1">
                        <input type="submit" class="w-full bg-blue-100 text-blue-600 p-3 mb-3 rounded-lg font-bold hover:bg-blue-600 hover:text-white hover:shadow-lg transition-all" value="Edit device"></input>
                    </div>
                </form>
            </main>
        </div>
    </section>

    <section class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="DeletePopup">   <!-- Delete device container -->
        <div class="w-96 bg-white p-4 rounded-lg shadow-lg">   <!-- Delete device popup -->
            <header class="p-4 text-center">
                <h1 class="font-bold text-xl">Are you sure?</h1>
            </header>
            <main>
                <form method="post" action="delete.php">
                    <p class="text-center">Are you sure to delete <b id="deleting" class="text-center break-all"></b> from the database?</p>
                    <div class="text-center pt-10 p-1 m-1">
                        <input class="hidden" type="number" name="D_id" id="deleteId">
                        <input class="hidden" type="number" name="D_confirm" id="deleteConfirm">
                        <button class="w-1/4 text-gray-700 p-3 mb-3 rounded-lg font-bold hover:bg-gray-500 hover:text-white hover:shadow-lg transition-all" onclick="PopupOut('DeletePopup');delFlag()">Cancel</i></button>
                        <input type="submit" class="w-1/4 bg-red-100 text-red-600 p-3 mb-3 rounded-lg font-bold hover:bg-red-600 hover:text-white hover:shadow-lg transition-all" value="Delete"></input>
                    </div>
                </form>
            </main>
        </div>
    </section>
<script src="main.js"></script>
</body>
</html>