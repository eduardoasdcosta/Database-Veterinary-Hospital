SELECT p.name as Name
FROM person AS p, client AS c, veterinary AS v, assistant AS a
WHERE p.VAT = c.VAT
AND (p.VAT = a.VAT OR p.VAT = v.VAT)
GROUP BY p.VAT;

