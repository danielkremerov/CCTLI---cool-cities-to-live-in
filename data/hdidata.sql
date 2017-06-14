DROP Table IF exists HDI;
CREATE TABLE HDI (
  Year int,
  Thailand text,
  UnitedStates text,
  Portugal text,
  Hungary text,
  Spain text,
  CzechRepublic text,
  Vietnam text,
  Indonesia text
);



INSERT INTO HDI VALUES
(1990, '0.572', '0.859', '0.710', '0.703', '0.756', '0.761', '0.475', '0.531'),
(2000, '0.648', '0.883', '0.782', '0.769', '0.827', '0.821', '0.575', '0.606'),
(2010, '0.716', '0.909', '0.819', '0.821', '0.867', '0.863', '0.653', '0.665'),
(2011, '0.721', '0.911', '0.825', '0.823', '0.870', '0.866', '0.657', '0.671'),
(2012, '0.723', '0.912', '0.827', '0.823', '0.874', '0.867', '0.660', '0.678'),
(2013, '0.724', '0.913', '0.828', '0.825', '0.874', '0.868', '0.663', '0.681'),
(2014, '0.726', '0.915', '0.830', '0.828', '0.876', '0.870', '0.666', '0.684');