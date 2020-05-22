<?php

//defined('BASEPATH') or exit('No direct script access allowed');

require_once('getid3/getid3.php');

class Admin extends CI_Controller
{
    const DOCUMENTARY = 'documentary';
    const EPISODE = 'episode';
    const MOVIE = 'movie';
    const COMEDY = 'comedy';

    const PATH_TO_PI = "../../../../home/pi/";
    const PATH_TO_PI_READ_EPISODES = 'exthd2/PiReadEpisodes';
    const PATH_TO_PI_READ_DOCUMENTARY = 'exthd2/PiReadDocumentary';
    const PATH_TO_PI_READ_COMEDY = 'exthd/PiReadComedy';
    const PATH_TO_PI_READ_MOVIES = 'exthd/PiReadMovies';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');

        if (!$this->authex->loggedIn()) {
            redirect('home/login');
        } else {
            $user = $this->authex->GetUserInfo();
            if ($user->level < 5) {
                redirect('home/login');
            }
        }
    }

    /**
     * Generates codes in database
     */
    public function generateCodes()
    {
		$data['user'] = $this->authex->getUserInfo();
        $data['title'] = 'Generate Registration codes';
        $data['footer'] = '';

		$this->admin_model->generateCodes();
        redirect('admin/getCodes');
    }

    /**
     * Returns template with the download requests
     */
    public function getRequests()
    {
		$data['user'] = $this->authex->getUserInfo();
        $data['movies'] = $this->admin_model->getRequests();
        $data['title'] = 'Download Requests';
        $data['footer'] = '';
        $partials = array('header' => 'main_header', 'content' => 'admin_requests');
        $this->template->load('main_master_admin', $partials, $data);
    }

    /**
     * Returns template with codes
     */
    public function getCodes()
    {
		$data['user'] = $this->authex->getUserInfo();
		$data['codes'] = $this->admin_model->getCodes();
        $data['title'] = 'Register Codes';
        $data['footer'] = '';
        $partials = array('header' => 'main_header', 'content' => 'admin_codes');
        $this->template->load('main_master_admin', $partials, $data);
    }

    /**
     * Returns template with userinfo
     */
    public function getUsers()
    {
		$data['user'] = $this->authex->getUserInfo();
		$data['users'] = $this->admin_model->getUsers();
        $data['title'] = 'Registered Users';
        $data['footer'] = '';
        $partials = array('header' => 'main_header', 'content' => 'admin_users');
        $this->template->load('main_master_admin', $partials, $data);
    }

    /**
     * Returns template with settings
     */
    public function getSettings()
    {
		$data['user'] = $this->authex->getUserInfo();
		$data['settings'] = $this->admin_model->getSettings();
        $data['user'] = $this->authex->getUserInfo();
        $data['title'] = 'Settings';
        $data['footer'] = '';
        $partials = array('header' => 'main_header', 'content' => 'admin_settings');
        $this->template->load('main_master_admin', $partials, $data);
    }

    public function updateSettings()
    {
        $setting = new stdClass();
        $setting->id = $this->input->post('id');
        $setting->flash_message_is_active = (bool)$this->input->post('flash_message_is_active');
        $setting->flash_message = $this->input->post('flash_message');

        $this->admin_model->updateSettings($setting);
        redirect('admin/getSettings');
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    private function startsWith($haystack, $needle)
    {
        $length = strlen($needle);

        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    private function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }

    /**
     * Reads the contents of a directory on the raspberri Pi
     * Returns an array with the read files
     *
     * @param $dir
     * @param $type
     * @return array
     */
    private function readContentsFromDirectory($dir, $type)
    {
        if ($dir !== "") {
            $dh = "";
            $fileSize = 0;
            $array = [];
            $returnArray = [];
            $returnArray['moviesArray'] = [];
            $returnArray['aantalFiles'] = 0;
            $returnArray['episodesArray'] = [];

            // MOVIES
            if ($type === self::MOVIE) {
                if (is_dir($dir)) {
                    if ($dh = opendir($dir)) {
                        while (($file = readdir($dh)) !== false) {
                            $array[$file] = $dir;
                        }
                        //reverse array omdat de rft file laatst staat en de id nodig heb voor de movies
                        $array2 = array_reverse($array);
                        foreach ($array2 as $file => $dir) {
                            // ignore hidden files, and files that starts with an underscore
                            if (!$this->startsWith($file, ".") && !$this->startsWith($file, "_")) {
                                // MOVIES
                                // enkel mp4 lezen
                                if ($this->endsWith($file, ".mp4")) {
                                    // $fileSize = filesize($dir . "/" . $file);
                                    //TODO *INFO* this function takes time!
                                    // $fileSize = $this->realFileSize($dir . "/" . $file);
                                    $fileSize = 0.00;

                                    $incomingMovie = $this->createMoviesFromFileReader($file, $fileSize, $dir);
                                    array_push($returnArray['moviesArray'], $incomingMovie);
                                    $returnArray['aantalFiles']++;
                                }
                            }
                        }
                        closedir($dh);
                    }
                }
            }

            // EPISODES
            if ($type === self::EPISODE) {
                if (is_dir($dir)) {

                    // get all subdirectories with path to read the dir in a second
                    $tempSubDirectoriesPaths = $this->getSubDirectories($dir);

                    // remove item at index 1 (it contains itself, the dir you want the subdirs of)
                    unset($tempSubDirectoriesPaths[0]);
                    // Re-index the array elements
                    $subDirectoriesPaths = array_values($tempSubDirectoriesPaths);
                    $subDirectoriesNames = [];

                    // get only the names of the subdirs
                    foreach ($subDirectoriesPaths as $subdir) {
                        //get the name of the dir
                        array_push($subDirectoriesNames, str_replace($dir . "/", "", $subdir));
                    }

                    $returnArray['episodesArray'] = $subDirectoriesNames;
                }
            }

            return $returnArray;
        }
    }

    /**
     * Return an array with the list of sub directories of $dir
     *
     * @param $dir
     * @return array
     */
    function getSubDirectories($dir)
    {
        $subDir = array();
        // Get and add directories of $dir
        $directories = array_filter(glob($dir), 'is_dir');
        $subDir = array_merge($subDir, $directories);
        // Foreach directory, recursively get and add sub directories
        foreach ($directories as $directory) {
            $subDir = array_merge($subDir, $this->getSubDirectories($directory . '/*'));
        }

        return $subDir;
    }

    /**
     * Reads the file size of a file
     *
     * @param $path
     * @return bool|float
     */
    public function realFileSize($path)
    {
        if (!file_exists($path)) {
            return false;
        }

        $size = filesize($path);

        if (!($file = fopen($path, 'rb'))) {
            return false;
        }

        if ($size >= 0) {//Check if it really is a small file (< 2 GB)
            if (fseek($file, 0, SEEK_END) === 0) {//It really is a small file
                fclose($file);
                return round(($size / 1000000000), 2); //TODO
            }
        }

        //Quickly jump the first 2 GB with fseek.
        // After that fseek is not working on 32 bit php (it uses int internally)
        $size = PHP_INT_MAX - 1;
        if (fseek($file, PHP_INT_MAX - 1) !== 0) {
            fclose($file);
            return false;
        }

        $length = 1024 * 1024;
        while (!feof($file)) {//Read the file until end
            $read = fread($file, $length);
            $size = bcadd($size, $length);
        }
        $size = bcsub($size, $length);
        $size = bcadd($size, strlen($read));

        fclose($file);
        if ($size > 0) {
            // groter dan 2 GB ?
            return round(($size / 1000000000), 2); //TODO
        }
    }

    /**
     * Creates the actual movies in the database depending on a read file from raspberryPi
     *
     * @param $file
     * @param $fileSize
     * @param $dir
     * @return stdClass
     */
    public function createMoviesFromFileReader($file, $fileSize, $dir)
    {
        // ingevulde forms aanmaken

        $naam = "naamloos";
        $jaar = "0000";
        $type = "DVD";
        $taal = "ENG";
        $duur = "0.00";
        $grootte = "0.00";
        $toegevoegd = date('Y-m-d', time());
        $download = 1;
        $imdb = "https";

        // .mp4 eruithalen
        $explodeArray_naam = explode(".mp4", $file);
        $naamZonderExtensie = rtrim($explodeArray_naam[0]); // eventuele laatste spatie op einde verwijderen

        // type (kwaliteit) eruithalen (via laatste 2 karakters)
        $_hulp_type = substr($naamZonderExtensie, -2);

        if (strtolower($_hulp_type) == "hd") {
            if (strtolower($_hulp_type) == "hd") {
                $type = "HD";
            }
            // "3D" of "HD" eruithalen
            $naamZonderExtensie = substr(
                $naamZonderExtensie,
                0,
                strlen($naamZonderExtensie) - 2
            );//laatste 2 karakters eraf knippen
        }
        $naamZonderExtensieEnZonderType = trim($naamZonderExtensie); // eventuele whitespace at end eruithalen

        // laatste 6 karakters eruithalen "(2020)" voor datum
        $jaar_hulp = substr(
            $naamZonderExtensieEnZonderType,
            strlen($naamZonderExtensie) - 7,
            strlen($naamZonderExtensie)
        );
        $jaar_hulp2 = trim($jaar_hulp);
        $jaar_hulp3 = substr($jaar_hulp2, 1, 4);
        // *OPSLAAN* JAAR
        $jaar = $jaar_hulp3;

        // verder werken met de titel
        $explodeArray_titel = explode(" (", $naamZonderExtensieEnZonderType); // enkel titel eruithalen
        $naam_hulp = rtrim($explodeArray_titel[0]);
        // mogelijk bevat deze nog haakjes , bv bij nl -> "(NL)"
        $naam_hulpDatumdeel = rtrim($explodeArray_titel[1]);

        // kijken of in de titel-sectie "3D" staat
        if (strpos($naam_hulp, '3D') !== false) {
            $type = "3D";//*OPSLAAN* TYPE
        }

        // kijken of in de datum-sectie "NL" staat
        if (strpos($naam_hulpDatumdeel, 'NL') !== false) {
            $naam_hulp = $naam_hulp . " NL"; // "NL" toevoegen aan de titel
            $taal = "NL";//*OPSLAAN* TAAL
        }

        // *OPSLAAN* NAAM
        $naam = $naam_hulp;

        // duration ophalen
        // TODO GAAT NIET VOOR FILES GROTER DAN 2GB
        //        $getID3 = new getID3;
        //        e($dir . "/" . $file);
        //        $_myFile = $getID3->analyze($dir . "/" . $file);
        //        e($_myFile);
        //        $duration_ruw = $_myFile['playtime_string'];
        // // genereert "21:33" (zit in "getid3.php -> analyze regel 493 'ChannelsBitratePlaytimeCalculations'")
        //
        //        if (strlen($duration_ruw) == 5) {
        //            $duration = "0." . substr($duration_ruw, 0, 2);
        //        }else{
        //
        //        }

        $movie = new stdClass();
        $movie->naam = strtoupper($naam);
        $movie->jaar = $jaar;
        $movie->type = strtoupper($type);
        $movie->taal = strtoupper($taal);
        $movie->duur = 0.00;
        $movie->grootte = $fileSize;
        $movie->toegevoegd = $toegevoegd;
        $movie->download = $download;
        $movie->imdb = $imdb;
        return $movie;
    }

    /**
     * Moves the files on the raspberryPi from the 'read-folder' to the correct folder
     *
     * @param $files
     * @param $movieType
     * @param $movieOfComedyOfDocumentary
     * @param $episodesDirectoryNames
     * @return array
     */
    private function moveFilesToTheCorrectDirectory(
        $files,
        $movieType,
        $movieOfComedyOfDocumentary,
        $episodesDirectoryNames = ""
    ) {
        // MOVIES
        if ($movieType === self::MOVIE) {
            foreach ($files as $movie) {
                //example $fileName: MOVIETITLE (3D) (2000) HD.mp4
                //example $correctFileName: MOVIETITLE 3D (2000).mp4

                // build oldname and newname
                $fileName = $movie->naam;
                $correctFileName = $movie->naam;
                if (strtolower($movie->taal) == 'nl' || strtolower($movie->taal) == '3d') {
                    $fileName .= ' (' . $movie->taal . ')';
                    $correctFileName .= ' ' . $movie->taal;
                }

                // if type id DVD, don't show that
                if ($movie->type === "DVD") {
                    $movie->type = "";
                    $fileName .= ' (' . $movie->jaar . ').mp4';

                } else {
                    $fileName .= ' (' . $movie->jaar . ') ' . $movie->type . '.mp4';
                }

                $correctFileName .= ' (' . $movie->jaar . ').mp4';

                // move to the correct folder on the raspberrPi
                if ($movieOfComedyOfDocumentary == self::MOVIE) {
                    $path = self::PATH_TO_PI . self::PATH_TO_PI_READ_MOVIES . '/';
                    $correctPath = self::PATH_TO_PI . "exthd/ftp/mp4/films/";
                }
                if ($movieOfComedyOfDocumentary == self::COMEDY) {
                    $path = self::PATH_TO_PI . self::PATH_TO_PI_READ_COMEDY . '/';
                    $correctPath = self::PATH_TO_PI . "exthd/ftp/mp4/comedy/";
                }

                if ($movieOfComedyOfDocumentary == self::DOCUMENTARY) {
                    $path = self::PATH_TO_PI . self::PATH_TO_PI_READ_DOCUMENTARY . '/';
                    $correctPath = self::PATH_TO_PI . "exthd2/ftp/mp4/documentary/";
                }

                try {
                    rename($path . $fileName, $correctPath . $correctFileName);
                } catch (\Exception $e) {
                    //todo (better to fix try catch block, other function than 'rename'?)
                }
            }

            // remove dot files and the directory itself
            if (isset($path)) {
                if ($movieOfComedyOfDocumentary === self::MOVIE || $movieOfComedyOfDocumentary === self::COMEDY) {
                    //first delete all dot files in the dir
                    array_map('unlink', glob(self::PATH_TO_PI . self::PATH_TO_PI_READ_MOVIES . "/" . "/._*"));
                    // delete other dot files
                    array_map('unlink', glob(self::PATH_TO_PI . "/exthd/._*"));
                }

                if ($movieOfComedyOfDocumentary === self::DOCUMENTARY) {
                    //first delete all dot files in the dir
                    array_map('unlink', glob(self::PATH_TO_PI . self::PATH_TO_PI_READ_DOCUMENTARY . "/" . "/._*"));
                    // delete other dot files
                    array_map('unlink', glob(self::PATH_TO_PI . "/exthd2/._*"));
                }

            }
        }

        // EPISODES
        if ($movieType === self::EPISODE) {
            $array = [];
            // loop over episode directories
            foreach ($episodesDirectoryNames as $episodename) {
                $dir = self::PATH_TO_PI . self::PATH_TO_PI_READ_EPISODES . '/' . $episodename;

                // read that dir for files (this is also a readDir function, can be refactored)
                if (is_dir($dir)) {
                    if ($dh = opendir($dir)) {
                        while (($file = readdir($dh)) !== false) {
                            $array[$file] = $dir;
                        }

                        // move each file from that dir
                        foreach ($array as $file => $dir) {
                            // ignore hidden files, and files that starts with an underscore
                            if (!$this->startsWith($file, ".") && !$this->startsWith($file, "_")) {
                                // enkel mp4 lezen
                                if ($this->endsWith($file, ".mp4")) {

                                    $oldPath = self::PATH_TO_PI . self::PATH_TO_PI_READ_EPISODES . "/" . $episodename . "/" . $file;
                                    $newPath = self::PATH_TO_PI . "exthd2/ftp/mp4/episodes/" . $file;

                                    try {
                                        rename($oldPath, $newPath);
                                    } catch (\Exception $e) {
                                        // todo (better to fix try catch block, other function than 'rename'?)
                                    }
                                }
                            }
                        }

                        closedir($dh);
                    }
                }
            }
            // remove dot files and the directory itself
            if (isset($episodename)) {
                //first delete all dot files in the dir, next delete the dir
                array_map('unlink',
                    glob(self::PATH_TO_PI . self::PATH_TO_PI_READ_EPISODES . "/" . $episodename . "/._*"));
                rmdir(self::PATH_TO_PI . self::PATH_TO_PI_READ_EPISODES . "/" . $episodename);

                // delete other dot files
                array_map('unlink', glob(self::PATH_TO_PI . "/exthd2/._*"));
                array_map('unlink', glob(self::PATH_TO_PI . self::PATH_TO_PI_READ_EPISODES . "/._*"));
            }
        }
    }

    // *************************
    // MAIN FUNCTIONS
    // *************************

    //MANUEEL
    /**
     * Main function: Add movies manually
     * Loads template to add movies manually
     *
     * @param string $filmOfComedy
     */
    public function addMoviesManueel($filmOfComedy = self::MOVIE)
    {
        //oude functie.. zonder reader
        $data['title'] = 'Add Movies';
        $data['user'] = $this->authex->getUserInfo();
        $data['footer'] = '';
        $data['huidigeDatum'] = date('Y-m-d', time());

        if ($filmOfComedy == self::MOVIE) {
            $data['movieOfComedyOfDocumentary'] = self::MOVIE;
            $data['title'] = 'Add Movies (manueel)';
        }

        if ($filmOfComedy == self::COMEDY) {
            $data['movieOfComedyOfDocumentary'] = self::COMEDY;
            $data['title'] = 'Add Comedy (manueel)';
        }

        $partials = array('header' => 'main_header', 'content' => 'admin_addMoviesManueel');
        $this->template->load('main_master_admin', $partials, $data);
    }

    /**
     * Inserts movies after submit of the form (after addMoviesManueel)
     * Redirects
     *
     * @param string $filmOfComedy
     */
    public function insertMovieManueel($filmOfComedy = self::MOVIE)
    {
        $movie = new stdClass();
        $movie->naam = $this->input->post('naam');
        $movie->jaar = $this->input->post('jaar');
        $movie->type = $this->input->post('type');
        $movie->taal = $this->input->post('taal');
        $movie->duur = $this->input->post('duur');
        $movie->grootte = $this->input->post('grootte');
        $movie->toegevoegd = $this->input->post('toegevoegd');
        $movie->download = $this->input->post('download');
        $movie->imdb = $this->input->post('imdb');

        if ($filmOfComedy == self::MOVIE) {
            $data['movieOfComedyOfDocumentary'] = self::MOVIE;
            $this->admin_model->insertMovie($movie);
            redirect('admin/addMoviesManueel/movie');
        }

        if ($filmOfComedy == self::COMEDY) {
            $data['movieOfComedyOfDocumentary'] = self::COMEDY;
            $this->admin_model->insertComedy($movie);
            redirect('admin/addMoviesManueel/comedy');
        }
    }

    // FILE READER

    /**
     * FileReader - Step 1
     *
     * Main function: ajaxReadFilesMovies
     *
     * @param string $filmOfComedyOfDocumentary
     * @param string $successMessage
     */
    public function ajaxReadFilesMovies($filmOfComedyOfDocumentary = self::MOVIE, $successMessage = 'index')
    {
        $dir = "";
        $data["successMessage"] = $successMessage;
        if ($filmOfComedyOfDocumentary == self::MOVIE) {
            $dir = self::PATH_TO_PI . self::PATH_TO_PI_READ_MOVIES;
        }

        if ($filmOfComedyOfDocumentary == self::COMEDY) {
            $dir = self::PATH_TO_PI . self::PATH_TO_PI_READ_COMEDY;
        }

        if ($filmOfComedyOfDocumentary == self::DOCUMENTARY) {
            $dir = self::PATH_TO_PI . self::PATH_TO_PI_READ_DOCUMENTARY;
        }

        $data['movies'] = "";

        $returnArray = $this->readContentsFromDirectory($dir, self::MOVIE);

        $data['movies'] = $returnArray['moviesArray'];
        $data['aantalFiles'] = $returnArray['aantalFiles'];

        if ($filmOfComedyOfDocumentary == self::MOVIE) {
            $this->addMovies($data);
        }

        if ($filmOfComedyOfDocumentary == self::COMEDY) {
            $this->addComedy($data);
        }
        if ($filmOfComedyOfDocumentary == self::DOCUMENTARY) {
            $this->addDocumentary($data);
        }
    }

    /**
     * FileReader - Step 1
     *
     * Main function: ajaxReadFilesEpisodes
     *
     * @param string $episodeOfDocumentary
     * @param string $successMessage
     */
    public function ajaxReadFilesEpisodes($episodeOfDocumentary = self::EPISODE, $successMessage = 'index')
    {
        $dir = "";
        //check if the episodes are 'episodes' or 'documentaries'
        $data["successMessage"] = $successMessage;
        if ($episodeOfDocumentary == self::DOCUMENTARY) {
            $dir = self::PATH_TO_PI . self::PATH_TO_PI_READ_DOCUMENTARY;
            $data["episodeOfDocumentary"] = self::DOCUMENTARY;
        }

        if ($episodeOfDocumentary == self::EPISODE) {
            $dir = self::PATH_TO_PI . self::PATH_TO_PI_READ_EPISODES;
            $data["episodeOfDocumentary"] = self::EPISODE;
        }

        // open the folder on pi, and read its content
        $returnArray = $this->readContentsFromDirectory($dir, self::EPISODE);

        $data['episodes'] = $returnArray['episodesArray'];
        $data['aantalFolders'] = sizeof($returnArray['episodesArray']);
        $data['huidigeDatum'] = date('Y-m-d', time());

        // insert the episodes into the database
        if ($episodeOfDocumentary == self::EPISODE) {
            $this->addEpisodes($data);
        }

        if ($episodeOfDocumentary == self::DOCUMENTARY) {
            $this->addDocumentary($data);
        }
    }

    /**
     * FileReader - Step 2
     *
     * Main function: Add Movies by Reader
     * Loads template to add movies automatically
     *
     * @param string $data
     */
    public function addMovies($data = "Geen data")
    {
        //via reader
        $data['title'] = 'Add Movies';
        $data['user'] = $this->authex->getUserInfo();
        $data['footer'] = '';
        $data['movieOfComedyOfDocumentary'] = self::MOVIE;
        $data['huidigeDatum'] = date('Y-m-d', time());

        $partials = array('header' => 'main_header', 'content' => 'admin_addMovies');
        $this->template->load('main_master_admin', $partials, $data);
    }

    /**
     * FileReader - Step 2
     *
     * Main function: Add Comedy by Reader
     * Loads template to add comedies automatically
     *
     * @param string $data
     */
    public function addComedy($data = "Geen data")
    {
        //via reader
        $data['title'] = 'Add Comedy';
        $data['user'] = $this->authex->getUserInfo();
        $data['footer'] = '';
        $data['movieOfComedyOfDocumentary'] = self::COMEDY;
        $data['huidigeDatum'] = date('Y-m-d', time());

        $partials = array('header' => 'main_header', 'content' => 'admin_addMovies');
        $this->template->load('main_master_admin', $partials, $data);
    }

    /**
     * FileReader - Step 2
     *
     * Main function: Add Comedy by Reader
     * Loads template to add comedies automatically
     *
     * @param string $data
     */
    public function addDocumentary($data = "Geen data")
    {
        //via reader
        $data['title'] = 'Add Documentary';
        $data['user'] = $this->authex->getUserInfo();
        $data['footer'] = '';
        $data['movieOfComedyOfDocumentary'] = self::DOCUMENTARY;
        $data['huidigeDatum'] = date('Y-m-d', time());

        $partials = array('header' => 'main_header', 'content' => 'admin_addMovies');
        $this->template->load('main_master_admin', $partials, $data);
    }

    /**
     * FileReader - Step 2
     *
     * Returns template with a filled form
     *
     * @param string $data
     */
    public function addEpisodes($data = "Geen data")
    {
        $data['title'] = 'Add Episodes';
        $data['user'] = $this->authex->getUserInfo();
        $data['footer'] = '';
        $data['episodeOfDocumentary'] = self::EPISODE;
        $data['huidigeDatum'] = date('Y-m-d', time());

        $partials = array('header' => 'main_header', 'content' => 'admin_addEpisodes');
        $this->template->load('main_master_admin', $partials, $data);
    }

    /**
     * FileReader - Step 3
     *
     * Inserts movies from the posted form (reader-mode form) into the database
     * and moves the read files to the correct
     */
    public function insertMovies()
    {
        $movies = [];
        // form listener
        $aantal = $this->input->post('aantalFiles');
        $movieOfComedyOfDocumentary = $this->input->post('movieOfComedyOfDocumentary');
        if ($aantal > 0) {
            $seizoenImage = null;
            if($movieOfComedyOfDocumentary == self::DOCUMENTARY)
            {
                $documentarySeizoenImage = $this->input->post('documentary-seizoen-image');
            }
            for ($i = 0; $i < $aantal; $i++) {
                $movie = new stdClass();
                $movie->naam = $this->input->post('naam' . $i);
                $movie->jaar = $this->input->post('jaar' . $i);
                $movie->type = $this->input->post('type' . $i);
                $movie->taal = $this->input->post('taal' . $i);
                $movie->duur = $this->input->post('duur' . $i);
                $movie->grootte = $this->input->post('grootte' . $i);
                $movie->toegevoegd = $this->input->post('toegevoegd' . $i);
                $movie->download = $this->input->post('download' . $i);
                $movie->imdb = $this->input->post('imdb' . $i);
                if($movieOfComedyOfDocumentary == self::DOCUMENTARY){
                    $movie->documentarySeizoenImage = $documentarySeizoenImage;
                }


                // create name of the file
                array_push($movies, $movie);
                if ($movieOfComedyOfDocumentary == self::MOVIE) {
                    $this->admin_model->insertMovie($movie);
                    $this->moveFilesToTheCorrectDirectory($movies, self::MOVIE, $movieOfComedyOfDocumentary);
                }

                if ($movieOfComedyOfDocumentary == self::COMEDY) {
                    $this->admin_model->insertComedy($movie);
                    $this->moveFilesToTheCorrectDirectory($movies, self::MOVIE, $movieOfComedyOfDocumentary);
                }
                if ($movieOfComedyOfDocumentary == self::DOCUMENTARY) {
                    $this->admin_model->insertDocumentary($movie);
                    $this->moveFilesToTheCorrectDirectory($movies, self::MOVIE, $movieOfComedyOfDocumentary);
                }
            }

            redirect('Movies/index');
        }

        redirect('admin/fail');
    }

    /**
     * FileReader - Step 3a
     *
     * @param string $episodeOfDocumentary
     * @throws getid3_exception
     */
    public function insertEpisodesSeizoen($episodeOfDocumentary = self::EPISODE)
    {
        $filesToMoveAfterInsertion = [];

        // form listener
        $aantalFolders = $this->input->post('aantalFolders');
        for ($i = 0; $i < $aantalFolders; $i++) {
            // foldernaam verwerken
            $fileNaam = $this->input->post('naam' . $i);
            $taal = $this->input->post('taal' . $i);
            $imdb = $this->input->post('imdb' . $i);

            $naamArray = explode("(", $fileNaam);
            $naam = trim($naamArray[0]);
            $_hulp_collectie = substr(
                $naam,
                0,
                strlen($naam) - 2
            ); // 2 getallen eruithalen en nadien een eventuele spatie (er zijn geen seizoenen met 3 getallen)
            $collectie = trim($_hulp_collectie);

            $jaarArray = explode(")", (string)$naamArray[1]);
            $jaar = $jaarArray[0];

            $_hulp_aantalEnTypeArray = explode("EPISODES", trim($jaarArray[1]));
            $_hulp_aantal = trim($_hulp_aantalEnTypeArray[0]);
            $_hulp_type = trim($_hulp_aantalEnTypeArray[1]);
            $aantalEpisodes = $_hulp_aantal;

            if ($_hulp_type == "HD") {
                $type = "HD";
            } elseif ($_hulp_type == "3D") {
                $type = "3D";
            } else {
                $type = "DVD";
            }

            $seizoen = new stdClass();
            $seizoen->naam = $naam;
            $seizoen->jaar = $jaar;
            $seizoen->type = $type;
            $seizoen->taal = $taal;
            $seizoen->aantalEpisodes = $aantalEpisodes;
            $seizoen->collectie = $collectie;
            $seizoen->toegevoegd = date('Y-m-d');
            $seizoen->aantalDownloads = 0;
            $seizoen->aantalRequests = 0;
            $seizoen->imdb = $imdb;
            $seizoen->download = 1;

            if ($episodeOfDocumentary == self::EPISODE) {
                $insertedSeizoenId = $this->admin_model->insertEpisodeSeizoenEpisode($seizoen);
                $this->insertEpisode($insertedSeizoenId, $fileNaam);
                array_push($filesToMoveAfterInsertion, $fileNaam);

            } elseif ($episodeOfDocumentary == self::DOCUMENTARY) {
                $insertedSeizoenId = $this->admin_model->insertEpisodeSeizoenDocumentary($seizoen);
                $this->insertDocumentary($insertedSeizoenId);
            }
        }

        //move all files to correct folder
        $this->moveFilesToTheCorrectDirectory([], self::EPISODE, "null", $filesToMoveAfterInsertion);

        redirect('Episodes/index');
    }

    /**
     * FileReader - Step 3b
     *
     * @param $insertedSeizoenId
     * @param $fileNaam
     * @throws getid3_exception
     */
    public function insertEpisode($insertedSeizoenId, $fileNaam)
    {
        $dir = self::PATH_TO_PI . self::PATH_TO_PI_READ_EPISODES . "/" . $fileNaam;

        // read dir
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                $arrayFiles[$file] = $dir;
            }
            asort($arrayFiles);
            $stringEpisodes = "";
            foreach ($arrayFiles as $file => $dir) {
                if (!$this->startsWith($file, ".")) {
                    if ($this->endsWith($file, ".mp4")) {
                        $downloadNaam = $file;

                        // file namen maken van de
                        // ".mp4" verwijderen
                        $_hulp_verwijderMP4array = explode(".mp4", $file);
                        $_naamZonderExtensie = trim($_hulp_verwijderMP4array[0]);

                        $_hulpNaamArray = explode(" - ", $_naamZonderExtensie);
                        $_hulp_naam = "";

                        if (sizeof($_hulpNaamArray) == 2) {
                            // twee delen, dus er staat geen extra "-" in de titel
                            $_hulp_naam = $_hulpNaamArray[1];
                        } elseif (sizeof($_hulpNaamArray) > 2) {
                            // meerdere delen, dus er staat een "-" in de titel !
                            for ($i = 0; $i < sizeof($_hulpNaamArray) - 1; $i++) {
                                $_hulp_naam .= $_hulpNaamArray[($i + 1)];

                                if ($i < sizeof($_hulpNaamArray) - 1) {
                                    $_hulp_naam .= "-";
                                }
                            }
                        } else {
                            // error
                        }

                        $naam = trim($_hulp_naam);

                        //$fileSize = filesize($dir . '/' . $file);
                        //TODO *INFO* this function takes time!
                        $fileSize = $this->realFileSize($dir . "/" . $file);

                        $getID3 = new getID3;
                        $_myFile = $getID3->analyze($dir . "/" . $file);
                        // genereert "21:33" (in "getid3.php > analyze regel 493 'ChannelsBitratePlaytimeCalculations'")
                        $duration_ruw = $_myFile['playtime_string'];

                        if (strlen($duration_ruw) == 5) {
                            $duration = "0." . substr($duration_ruw, 0, 2);
                        }

                        //EXTRA INFO TODO expand this info
                        //$fileSize = $_myFile['filesize'];
                        //$audioCodec = $_myFile['audio']['codec'];
                        //$audioSampleRate = $_myFile['audio']['sample_rate'];
                        //$audioChannels = $_myFile['audio']['channels'];
                        //$audioBitsPerSample = $_myFile['audio']['bits_per_sample'];
                        //$videoResolution = $_myFile['video']['resolution_x']."x" . $_myFile['video']['resolution_y'];
                        //$videoFrameRate = $_myFile['video']['frame_rate'];
                        //
                        //e($fileSize);
                        //e($audioCodec);
                        //e($audioSampleRate);
                        //e($audioChannels);
                        //e($audioBitsPerSample);
                        //e($videoResolution);
                        //e($videoResolution);

                        $episode = new stdClass();
                        $episode->seizoenId = $insertedSeizoenId;
                        $episode->naam = $naam;
                        $episode->duur = $duration;
                        $episode->grootte = $fileSize;
                        $episode->download = 1;
                        $episode->aantalDownloads = 0;
                        $episode->aantalRequests = 0;
                        $episode->downloadNaam = $downloadNaam;

                        $this->admin_model->insertEpisode($episode);
                    }
                }
            }
        }
    }

	/**
	 * Update subscription with today's date
	 *
	 * @param int $userId the id of the user that needs to get a new subscriptionDate 'geabonneerd'
	 */
	public function updateSubscription($userId)
	{
		$this->load->model('user_model');
		$this->user_model->updateSubscription($userId);
		redirect('admin/getUsers');
	}
}
