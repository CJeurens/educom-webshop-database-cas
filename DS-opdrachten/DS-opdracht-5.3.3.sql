SELECT 
S.name AS leverancier,
IF(D.contact<>"",D.contact,"t.a.v. de directie") AS contact,
V.adres,
V.postcode,
V.stad

FROM mhl_suppliers AS S

LEFT JOIN directie AS D ON (D.supplier_ID=S.id)
LEFT JOIN verzendlijst AS V ON (V.supplier_ID=S.id);