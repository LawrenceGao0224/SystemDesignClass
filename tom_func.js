
function products_check(fid)//產品報備表-前台
{
		<!-- 若<form>屬性name值為reg裡的文字方塊值為空字串，則顯示「未輸入姓名」 -->
		if(myform.sle_a.value == ""){
			//document.myform.fid.value = "NewUser";
			alert("報備產品未輸入！");
		}else if(myform.proj_cash.value == ""){
			alert("整案預估金額未輸入！");
			
		}else if(myform.product_cash.value == ""){
			alert("相關產品金額未輸入!");
			
		}else if(myform.product_text.value == ""){
			alert("報備產品未輸入!");
			
		}else if(myform.proj_status.value == ""){
			alert("目前案件狀態未輸入!");
			
		}else if(myform.proj_support.value == ""){
			alert("專案支援理由未輸入!");
			
		}else if(myform.sle_b.value == ""){
			alert("此案銷售類型未輸入!");
			
		}else if(myform.datepicker.value == ""){
			alert("預計下單日未輸入!");
			
		}else if(myform.bus_name.value == ""){
			alert("盟立業務人員未輸入!");
			
		}else if(myform.mail.value == ""){
			alert("盟立業務電子郵件未輸入!");
			
		}else if(myform.bus_phone.value == ""){
			alert("盟立業務電話未輸入!");
			
		}else if(myform.proj_name.value == ""){
			alert("專案名稱未輸入!");
			
		}else if(myform.com_name.value == ""){
			alert("使用單位未輸入!");
			
		}else if(myform.person_name.value == ""){
			alert("承辦人姓名未輸入!");
			
		}else if(myform.person_branch.value == ""){
			alert("承辦人部門單位未輸入!");
			
		}else if(myform.person_title.value == ""){
			alert("承辦人部門職稱未輸入!");
			
		}else if(myform.person_mail.value == ""){
			alert("承辦人電子郵件未輸入!");
			
		}else if(myform.person_phone.value == ""){
			alert("承辦人聯絡電話未輸入!");
			
		}else if(myform.person_address.value == ""){
			alert("承辦人單位地址未輸入!");
			
		}else{
		<!-- 若以上條件皆不符合，也就是表單資料皆有填寫的話，則將資料送出 -->
			document.myform.fid.value = fid; //sqlNewPurchase
			document.myform.submit();
		}	
		
 }

function newQuoted(fid)//新增

{
	if(myform.client_name.value == ""){
			alert("客戶名稱未輸入！");
		}else if(myform.client_address.value == ""){
			alert("客戶地址未輸入！");			
		}else if(myform.client_window.value == ""){
			alert("聯絡人/職稱未輸入！");			
		}else if(myform.client_phone.value == ""){
			alert("客戶電話未輸入！");			
		}else if(myform.client_num.value == ""){
			alert("報價編號未輸入！");			
		}else if(myform.client_mail.value == ""){
			alert("客戶信箱未輸入！");			
		}else if(myform.bus_name.value == ""){
			alert("盟立業務姓名未輸入！");			
		}else if(myform.bus_phone.value == ""){
			alert("盟立業務電話未輸入！");			
		}else if(myform.bus_cellphone.value == ""){
			alert("盟立業務手機未輸入！");			
		}else if(myform.bus_mail.value == ""){
			alert("盟立業務信箱未輸入！");			
		}else{
		<!-- 若以上條件皆不符合，也就是表單資料皆有填寫的話，則將資料送出 -->
			document.myform.fid.value = fid;
			document.myform.submit();
		}
		
}

function editPrice(fid,priceA_id)
{
	//alert(fid);
	document.myform.fid.value = fid;

	document.myform.priceA_id.value = priceA_id;

	document.myform.submit();

}

function sqlDelitems(priceA_id,priceB_id)
{
	//alert(price_id);
	document.myform.fid.value = "sqlDelitems";

	document.myform.priceA_id.value = priceA_id;
	document.myform.param2.value = priceB_id;
	document.myform.submit();

}

function saveQuoted(fid,priceA_id)//新增

{
	if(myform.client_name.value == ""){
			alert("客戶名稱未輸入！");
		}else if(myform.client_address.value == ""){
			alert("客戶地址未輸入！");			
		}else if(myform.client_window.value == ""){
			alert("聯絡人/職稱未輸入！");			
		}else if(myform.client_phone.value == ""){
			alert("客戶電話未輸入！");			
		}else if(myform.client_num.value == ""){
			alert("報價編號未輸入！");			
		}else if(myform.client_mail.value == ""){
			alert("客戶信箱未輸入！");			
		}else if(myform.bus_name.value == ""){
			alert("盟立業務姓名未輸入！");			
		}else if(myform.bus_phone.value == ""){
			alert("盟立業務電話未輸入！");			
		}else if(myform.bus_cellphone.value == ""){
			alert("盟立業務手機未輸入！");			
		}else if(myform.bus_mail.value == ""){
			alert("盟立業務信箱未輸入！");			
		}else{
		<!-- 若以上條件皆不符合，也就是表單資料皆有填寫的話，則將資料送出 -->
			document.myform.fid.value = fid;
			document.myform.priceA_id.value = priceA_id;
			document.myform.submit();
		}
		
}

function jumpPreview(fid,priceA_id)
{
	//alert(fid);
	document.myform.fid.value = fid;

	document.myform.priceA_id.value = priceA_id;

	document.myform.submit();

}

function DelPrice(fid,priceA_id)
{
	//alert(fid);
	document.myform.fid.value = fid;

	document.myform.priceA_id.value = priceA_id;

	document.myform.submit();

}
