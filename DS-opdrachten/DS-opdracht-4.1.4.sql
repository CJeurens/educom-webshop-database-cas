SELECT mhl_suppliers.name,mhl_suppliers.straat,mhl_suppliers.huisnr,mhl_suppliers.postcode
FROM `mhl_suppliers`
LEFT JOIN `mhl_yn_properties` ON (mhl_yn_properties.supplier_ID=mhl_suppliers.id)
LEFT JOIN `mhl_propertytypes` ON (mhl_yn_properties.propertytype_ID=mhl_propertytypes.id)

WHERE mhl_propertytypes.name="ook voor particulieren" 
OR mhl_propertytypes.name="specialistische leverancier";