CREATE VIEW VERZENDLIJST AS

SELECT
S.id AS supplier_ID,
IF (S.p_address<>"",S.p_address,CONCAT(S.straat," ",S.huisnr)) AS adres,
IF (S.p_address<>"",S.p_postcode,S.postcode) AS postcode,
IF (S.p_address<>"",PC.name,C.name) AS stad

FROM mhl_suppliers AS S

LEFT JOIN mhl_cities AS C ON (S.city_id=C.id)
LEFT JOIN mhl_cities AS PC ON (S.p_city_ID=PC.id);