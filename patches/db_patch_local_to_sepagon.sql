# PATCH LOCAL TO MOVIES.SEPAGON
UPDATE `documentarySeizoen` SET imageUrl = REPLACE(imageUrl, 'http://movies.local', 'https://movies.sepagon.be');
UPDATE `episodesSeizoen` SET imageUrl = REPLACE(imageUrl, 'http://movies.local', 'https://movies.sepagon.be');
