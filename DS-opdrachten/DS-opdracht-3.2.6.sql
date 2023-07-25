SELECT name,straat,huisnr,postcode from `mhl_suppliers` 
WHERE (huisnr BETWEEN 10 AND 20) OR (huisnr > 100);