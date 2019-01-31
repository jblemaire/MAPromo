<?php

use Illuminate\Database\Seeder;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**Internaute**/
        $internaute1 = DB::table('internaute')->insertGetId([
            'nomInternaute' => 'Vaujambon',
            'prenomInternaute' => 'Andy',
            'mailInternaute' => 'andyvaujambon05@gmail.com',
            'mdpInternaute' => ''
        ]);
        $internaute2 = DB::table('internaute')->insertGetId([
            'nomInternaute' => 'Cobeure',
            'prenomInternaute' => 'Harry',
            'mailInternaute' => 'xharrycotblancx@gmail.com',
            'mdpInternaute' => ''
        ]);
        $internaute3 = DB::table('internaute')->insertGetId([
            'nomInternaute' => 'Orak',
            'prenomInternaute' => 'Anne',
            'mailInternaute' => 'anneorakdu04@orange.fr',
            'mdpInternaute' => ''
        ]);

        /**Responsable**/
        $resp1 = DB::table('responsable')->insertGetId([
            'nomResponsable' => 'Croche',
            'prenomResponsable' => 'Sarah',
            'mailResponsable' => 'crochesarah@gmail.com',
            'mdpResponsable' => ''
        ]);
        $resp2 = DB::table('responsable')->insertGetId([
            'nomResponsable' => 'Encieu',
            'prenomResponsable' => 'Cécile',
            'mailResponsable' => 'cécileencieu@gmail.com',
            'mdpResponsable' => ''
        ]);
        $resp3 = DB::table('responsable')->insertGetId([
            'nomResponsable' => 'Timètre',
            'prenomResponsable' => 'Vincent',
            'mailResponsable' => 'vincenttimetre@orange.fr',
            'mdpResponsable' => ''
        ]);

        /**Type**/
        $type1 = DB::table('type')->insertGetId([
            'libType' => 'Boucherie'
        ]);
        $type2 = DB::table('type')->insertGetId([
            'libType' => 'Bar'
        ]);
        $type3 = DB::table('type')->insertGetId([
            'libType' => 'Fast-Food'
        ]);

        /**Categorie**/
        $cat1 = DB::table('categorie')->insertGetId([
            'libCategorie' => 'Hallal',
            'idType' => $type1
        ]);
        $cat2 = DB::table('categorie')->insertGetId([
            'libCategorie' => 'Pub',
            'idType' => $type2
        ]);
        $cat3 = DB::table('categorie')->insertGetId([
            'libCategorie' => 'Cave',
            'idType' => $type2
        ]);

        /**Magasin**/
        $mag1 = DB::table('magasin')->insertGetId([
            'nomMagasin' => 'La Petite Boucherie',
            'adresse1Magasin' => '',
            'adresse2Magasin' => 'Square Voltaire',
            'latMagasin' => 48.862725,
            'longMagasin' => 2.287592000000018,
            'mailMagasin' => 'lapetiteboucherie05@gmail.com',
            'siretMagasin' => '',
            'codeINSEEVille' => '05061',
            'idResponsable' => $resp1,
            'idType'=> $type1
        ]);

        $mag2 = DB::table('magasin')->insertGetId([
            'nomMagasin' => 'The Black Lions',
            'adresse1Magasin' => '1',
            'adresse2Magasin' => 'Rue Amédée Para',
            'latMagasin' => 44.5583992,
            'longMagasin' => 6.077590500000042,
            'mailMagasin' => 'theblacklions@gmail.com',
            'siretMagasin' => '',
            'codeINSEEVille' => '05061',
            'idResponsable' => $resp2,
            'idType'=> $type2,
            'idCategorie' =>  $cat2
        ]);

        $mag3 = DB::table('magasin')->insertGetId([
            'nomMagasin' => 'My Beers Gap',
            'adresse1Magasin' => '9021',
            'adresse2Magasin' => 'Route des Fauvins',
            'latMagasin' => 44.5640873,
            'longMagasin' => 6.092279700000063,
            'mailMagasin' => 'gap@mybeers.fr',
            'siretMagasin' => '',
            'codeINSEEVille' => '05061',
            'idResponsable' => $resp3,
            'idType'=> $type2,
            'idCategorie' =>  $cat3
        ]);

        $mag4 = DB::table('magasin')->insertGetId([
            'nomMagasin' => 'Burger And Grill\'s',
            'adresse1Magasin' => '8',
            'adresse2Magasin' => 'Place du Revelly',
            'latMagasin' => 44.5609758,
            'longMagasin' => 6.08006720000003,
            'mailMagasin' => 'gap@burgerandgrills.fr',
            'siretMagasin' => '80405805500018',
            'codeINSEEVille' => '05061',
            'idResponsable' => $resp2,
            'idType'=> $type3
        ]);

        $mag5 = DB::table('magasin')->insertGetId([
            'nomMagasin' => 'Chez Fred',
            'adresse1Magasin' => '10',
            'adresse2Magasin' => 'Boulevard de la Libération',
            'latMagasin' => 44.56113799999999,
            'longMagasin' => 6.078820700000051,
            'mailMagasin' => 'gap@chezfred.fr',
            'siretMagasin' => '',
            'codeINSEEVille' => '05061',
            'idResponsable' => $resp1,
            'idType'=> $type3
        ]);

        /**Promotion**/
        $promo1 = DB::table('promotion')->insertGetId([
            'dateDebutPromo' => '2019-01-15',
            'dateFinPromo' => '2019-01-31',
            'libPromo' => 'Toutes les pressions à -50% avant 20h',
            'etatPromo' => 1,
            'codePromo' => 'TBL',
            'codeAvisPromo' => 'Gu1',
            'idMagasin' => $mag2
        ]);

        $promo2 = DB::table('promotion')->insertGetId([
            'dateDebutPromo' => '2019-01-01',
            'dateFinPromo' => '2019-01-13',
            'libPromo' => 'Toutes les pizzas sont à -20%',
            'etatPromo' => 0,
            'codePromo' => 'PIZ',
            'codeAvisPromo' => 'B9P',
            'idMagasin' => $mag5
        ]);

        $promo3 = DB::table('promotion')->insertGetId([
            'dateDebutPromo' => '2019-01-21',
            'dateFinPromo' => '2019-02-21',
            'libPromo' => 'GigaTacos à -10% pour les étudiants',
            'etatPromo' => 1,
            'codePromo' => 'GT3',
            'codeAvisPromo' => '89P',
            'idMagasin' => $mag4
        ]);

        /**Adhésion**/
        DB::table('adhesion')->insertGetId([
            'Promotion_idPromo' => $promo1,
            'Internaute_idInternaute' => $internaute2,
            'noteAdhesion' => 4,
            'commentaireAdhesion' => 'La bière était trop bonnes, vive la Guiness!'
        ]);

        DB::table('adhesion')->insertGetId([
            'Promotion_idPromo' => $promo2,
            'Internaute_idInternaute' => $internaute1,
            'noteAdhesion' => 1,
            'commentaireAdhesion' => 'De toute façon elles sont pas bonnes les pizzas'
        ]);

        DB::table('adhesion')->insertGetId([
            'Promotion_idPromo' => $promo1,
            'Internaute_idInternaute' => $internaute3,
            'noteAdhesion' => 3,
            'commentaireAdhesion' => 'Cool'
        ]);
    }
}
