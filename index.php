<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardware store</title>
    <script src="https://cdn.tailwindcss.com"></script>   <!-- Implementing TailwindCSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   <!-- Implementing FontAwesome (font icons) -->
</head>
<body class="bg-gray-100 text-gray-700">
    <div class="pt-10 mx-36">   <!-- Content wrapper -->
        <div class="bg-white p-4 mx-auto rounded-lg shadow-lg">

            <div class="float-right">   <!-- Button wrapper -->
                <button class="bg-blue-100 text-blue-600 px-5 p-3 mb-3 rounded-lg font-bold hover:bg-blue-600 hover:text-white hover:shadow-lg transition-all">Add device</button>
            </div>

            <div class="clear-both overflow-auto">   <!-- Table wrapper -->
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
                                        <td class="p-1"><button class="px-3 py-1 m-1 rounded-lg bg-red-100 text-red-600 font-bold hover:bg-red-600 hover:text-white hover:shadow-lg transition-all"><i class="fa fa-trash-o"></i></button></td>
                                    </tr>
                            <?php }
                            }?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>