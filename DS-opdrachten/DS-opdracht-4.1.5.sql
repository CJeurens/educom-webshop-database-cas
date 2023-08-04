SELECT mhl_suppliers.name,mhl_suppliers.straat,mhl_suppliers.huisnr,mhl_suppliers.postcode,pc_lat_long.lat,pc_lat_long.lng
FROM `mhl_suppliers`
LEFT JOIN pc_lat_long ON (mhl_suppliers.postcode=pc_lat_long.pc6)
ORDER BY pc_lat_long.lat DESC
LIMIT 5