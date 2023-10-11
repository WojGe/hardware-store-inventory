/**
 * This function will show a popup window
 * defined by its corresponding id.
 * 
 * @param {string} window - ID of the specified popup window
 */
function PopupIn(window){
    const PopIn = document.getElementById(window);
    PopIn.classList.remove("hidden");
}

/**
 * This function will hide a popup window
 * defined by its corresponding id.
 * 
 * @param {string} window - ID of the specified popup window
 */
function PopupOut(window){
    const PopOut = document.getElementById(window);
    PopOut.classList.add("hidden");
}



/**
 * Global variables (look description below)
 */
let Gid;
let Gcategory;
let Gbrand;
let Gmodel;
let Gquantity;
let Gcondition;
let Gnotes;

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
function data(id, category, brand, model, quantity, condition, details, image){
    Gid = id;
    Gcategory = category;
    Gbrand = brand;
    Gmodel = model;
    Gquantity = quantity;
    Gcondition = condition;
    Gdetails = details;
    Gimage = image;
}



/**
 * This function displays details of specific device
 * from the global variables.
 */
function details(){
const header = document.getElementById("detailsOf");
const detailsId = document.getElementById("detailsId");
const detailsCategory = document.getElementById("detailsCategory");
const detailsBrand = document.getElementById("detailsBrand");
const detailsModel = document.getElementById("detailsModel");
const detailsQuantity = document.getElementById("detailsQuantity");
const detailsCondit = document.getElementById("detailsCondit");
const detailsAd = document.getElementById("detailsAd");
const detailsImage = document.getElementById("detailsImage");
const deleteImage = document.getElementById("detailsDelImage");
header.innerText = "Details of " + Gbrand + " " + Gmodel;
detailsId.innerText = Gid;
detailsCategory.innerText = Gcategory;
detailsBrand.innerText = Gbrand;
detailsModel.innerText = Gmodel;
detailsQuantity.innerText = Gquantity;
detailsCondit.innerText = Gcondition;
detailsAd.innerText = Gdetails;
if (Gimage!=0){
    detailsImage.classList.remove("hidden");
    deleteImage.classList.remove("hidden");
    detailsImage.src="images/" + Gimage;
    detailsImage.alt="image of " + Gbrand +" "+ Gmodel; 
}else{
    detailsImage.classList.add("hidden");
    deleteImage.classList.add("hidden");
}
}



/**
 * This function displays values of the specified device
 * (defined by global variables) in the form.
 */
function edit(){
const header = document.getElementById("editing");
header.innerText = "Editing " + Gbrand + " " + Gmodel;
const editId = document.getElementById("editId");
const editCategory = document.getElementById("editCategory");
const editBrand = document.getElementById("editBrand");
const editModel = document.getElementById("editModel");
const editQuantity = document.getElementById("editQuantity");
const editCondit = document.getElementById("editCondition");
const editDetails = document.getElementById("editDetails");
editId.value = Gid;
editCategory.value = Gcategory;
editBrand.value = Gbrand;
editModel.value = Gmodel;
editQuantity.value = Gquantity;
editCondit.value = Gcondition;
editDetails.value = Gdetails;
}



/**
 * DELETE DEVICE
 * 
 * These functions sends id of a specified device to the form,
 * set/removes the flag that prevents from the bug that deletes
 * record via any button (cancel or delete) and asks the user
 * if he/she is sure to delete the record.
 */
function del(){
    const deleteId = document.getElementById("deleteId");
    const deleteFlag = document.getElementById("deleteConfirm");
    const paragraph = document.getElementById("deleting");
    paragraph.innerText = Gbrand + " " + Gmodel;
    deleteId.value = Gid;
    deleteFlag.value = 1;
}
function delFlag(){
    const deleteFlag = document.getElementById("deleteConfirm");
    deleteFlag.value = 0;
}



/**
 * DELETE IMAGE OF DEVICE
 * 
 * These functions sends id of a specified device to the form,
 * set/removes the flag that prevents from the bug that deletes
 * record via any button (cancel or delete) and asks the user
 * if he/she is sure to delete image of the device.
 */
function delImg(){
    const delImgId = document.getElementById("delImgId");
    const delImgFlag = document.getElementById("delImgConfirm");
    const paragraph = document.getElementById("deletingImg");
    paragraph.innerText = Gbrand + " " + Gmodel;
    delImgId.value = Gid;
    delImgFlag.value = 1;
}
function imgFlag(){
    const delImgFlag = document.getElementById("delImgConfirm");
    delImgFlag.value = 0;
}