<?php

class Pages {

    /**
     * Récupération du nombre de page totale pour la pagination
     * @return int
     */
    private static function howManyPages (int $idCreator, int $role = 0) :int {
        $databaseConnection = Database::getConnection();
        $sql = 'SELECT COUNT(`Id_users`) AS total FROM `users` WHERE `created_by` = :created';
        if ($role == 0) {
            $sql .= ' AND `Id_role` = 2 ;';
        } else {
            $sql .= ' AND `Id_role` = 3 ;';
        }
        $query = $databaseConnection->prepare($sql);
        $query->bindValue(':created', $idCreator, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        $totalPages = intdiv($result->total, 10);
        return $result->total % 10 > 0 ? $totalPages++ : $totalPages;
    }

    /**
     * Récupération du numéro de page en méthode GET
     * @return int
     */
    private static function whichPage () :int {
        if (isset($_GET['page'])) {
            $input = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
            if (validationInput($input, REGEX_PAGE) == true) {
                $page = $input;
            } else {
                $page = 1;
            }
        } else {
            $page = 1;
        }
        return intval($page, 10);
    }

    /**
     * Récupération de 10 clients par page
     * @return array
     */
    private static function get (int $idCreator, int $role = 0) :array {
        $databaseConnection = Database::getConnection();
        $sql = 'SELECT `lastname`, `firstname`, `Id_users` FROM `users`';
        if ($role == 0) {
            $sql .= ' WHERE `Id_role` = 2';
        } else {
            $sql .= ' WHERE `Id_role` = 3';
        }
        $sql .= ' AND `created_by` = :created ORDER BY `lastname` ASC LIMIT :numberPerPage OFFSET :offset ;';
        $query = $databaseConnection->prepare($sql);
        $query->bindValue(':created', $idCreator, PDO::PARAM_INT);
        $query->bindValue(':numberPerPage', 10, PDO::PARAM_INT);
        $query->bindValue(':offset', (self::whichPage() - 1) * 10, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * @param int $idCreator
     * 
     * @return string
     */
    public static function display (int $idCreator, int $role = 0) :string {
        $page = self::whichPage();
        if ($role == 0) {
            $pages = self::howManyPages($idCreator);
            $getTen = self::get($idCreator);
        } else {
            $pages = self::howManyPages($idCreator, $role);
            $getTen = self::get($idCreator, $role);
        }
        $html = '<div class="containerSubject">
            <div class="containerTitleListing flexCenterCenter">
                <div class="containerAdd flexCenterCenter">
                    <i class="fa-solid fa-plus"></i>
                </div>';
        if ($role == 0) {
            $html .= '<h3>Employés</h3>';
        } else {
            $html .= '<h3>Clients</h3>';
        }
        $html .= '</div>
            <div class="containerContent flexCenterColumn">';
                foreach ($getTen as $getOne) {
                $html .= '<div class="listingRecap flexCenterBetween">
                        <div class="containerInformations">
                            <div class="containerPicture">
                                <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80" alt="">
                            </div>
                            <div class="containerName">
                                <p>'.$getOne->lastname.' '.$getOne->firstname.'</p>
                            </div>
                        </div>
                        <div class="containerMore flexCenterCenter">
                            <div class="containerPlus flexCenterCenter">';
                                if ($role == 0) {
                                    $html .= '<a href="/dashboard/profil-employe?id='.$getOne->Id_users.'"><i class="fa-regular fa-eye"></i></a>';
                                } else {
                                    $html .= '<a href="/dashboard/profil-client?id='.$getOne->Id_users.'"><i class="fa-regular fa-eye"></i></a>';
                                }
                            $html .= '</div>
                        </div>      
                    </div>';
                };
            $html .= '</div>
            <div class="pagesListing">';
                if (isset($page) && $page > 1) {
                    $html .= '<div class="containerPages flexCenterCenter">';
                        if ($page == 1) {
                            $html .= '<div class="containerPage flexCenterCenter"></div>';
                        } else {
                            $html .= '<div class="containerPage flexCenterCenter">';
                            if ($role == 0) {
                                $html .= '<a href="/dashboard/employes?page='. $page-- .'>"><i class="fa-solid fa-chevron-left"></i></a>';
                            } else {
                                $html .= '<a href="/dashboard/clients?page='. $page-- .'>"><i class="fa-solid fa-chevron-left"></i></a>';
                            }
                            $html .= '</div>';
                        }
                        if ($page == $pages) {
                            $html .= '<div class="containerPage flexCenterCenter"></div>';
                        } else {
                            $html .= '<div class="containerPage flexCenterCenter">';
                            if ($role == 0) {
                                $html .= '<a href="/dashboard/employes?page='. $page++ .'>"><i class="fa-solid fa-chevron-right"></i></a>';
                            } else {
                                $html .= '<a href="/dashboard/clients?page='. $page++ .'>"><i class="fa-solid fa-chevron-right"></i></a>';
                            }
                            $html .= '</div>';
                        }
                        $html .= '</div>';
                    }
            $html .= '</div>
        </div>';
    return $html;
    }

}