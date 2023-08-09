CREATE VIEW DIRECTIE AS

SELECT
C.supplier_ID,
C.name AS contact,
C.contacttype AS functie,
D.name AS department

FROM mhl_contacts AS C

LEFT JOIN mhl_departments AS D ON (C.department=D.id)

WHERE D.name = "Directie"
OR C.contacttype LIKE "%directeur%";