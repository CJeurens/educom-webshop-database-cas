SELECT mhl_suppliers.name,mhl_suppliers.straat,mhl_suppliers.huisnr,mhl_suppliers.postcode 
FROM `mhl_suppliers` 
LEFT JOIN `mhl_cities` ON (mhl_suppliers.city_ID=mhl_cities.id)
LEFT JOIN `mhl_suppliers_mhl_rubriek_view` ON (mhl_suppliers.id=mhl_suppliers_mhl_rubriek_view.mhl_suppliers_ID)
LEFT JOIN `mhl_rubrieken` ON (mhl_suppliers_mhl_rubriek_view.mhl_rubriek_view_ID=mhl_rubrieken.id)

WHERE mhl_cities.name LIKE "%_msterdam%" AND (mhl_rubrieken.id=235 OR mhl_rubrieken.parent=235)
ORDER BY mhl_rubrieken.name,mhl_suppliers.name;

/*
rubriek_id 235 = drank
parent 235 = drank subrubriek
*/