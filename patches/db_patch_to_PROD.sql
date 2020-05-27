# PATCH: movies.local -> movies.sepagon.be

UPDATE `documentarySeizoen` SET imageUrl = REPLACE(imageUrl, 'http://movies.local', 'https://movies.sepagon.be');
UPDATE `episodesSeizoen` SET imageUrl = REPLACE(imageUrl, 'http://movies.local', 'https://movies.sepagon.be');
