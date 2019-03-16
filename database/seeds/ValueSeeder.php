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
        /**Role**/
        DB::table('roles')->insertGetId([
            'libRole' => 'Admin'
        ]);

        DB::table('roles')->insertGetId([
            'libRole' => 'Internaute'
        ]);

        DB::table('roles')->insertGetId([
            'libRole' => 'Responsable'
        ]);

        /**User**/
        DB::table('users')->insertGetId([
            'nomUser' => 'Mapromo',
            'prenomUser' => 'admin',
            'mailUser' => 'mapromo.site@gmail.com',
            'mdpUser' => bcrypt('MAPromo2019'), // secret
            'telUser' => '',
            'idRole' => 1
        ]);

        //factory(App\User::class, 100)->create();

        /**Type**/
        $type1 = DB::table('types')->insertGetId([
            'libType' => 'Animalerie'
        ]);
        $type2 = DB::table('types')->insertGetId([
            'libType' => 'Restaurant'
        ]);
        $type3 = DB::table('types')->insertGetId([
            'libType' => 'Chocolaterie'
        ]);
        $type4 = DB::table('types')->insertGetId([
            'libType' => 'Armurerie'
        ]);
        $type5 = DB::table('types')->insertGetId([
            'libType' => 'Grande Surface'
        ]);
        $type6 = DB::table('types')->insertGetId([
            'libType' => 'Pâtisserie'
        ]);
        $type7 = DB::table('types')->insertGetId([
            'libType' => 'Boulangerie'
        ]);
        $type8 = DB::table('types')->insertGetId([
            'libType' => 'Boucherie'
        ]);
        $type9 = DB::table('types')->insertGetId([
            'libType' => 'Poissonerie'
        ]);
        $type10 = DB::table('types')->insertGetId([
            'libType' => 'Sex-shop'
        ]);
        $type11 = DB::table('types')->insertGetId([
            'libType' => 'Débit de boisson'
        ]);

        /**Categorie**/
        $cat1 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Pizzeria',
            'idType' => $type2
        ]);
        $cat2 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Fast-food',
            'idType' => $type2
        ]);
        $cat3 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Sandwicherie',
            'idType' => $type2
        ]);
        $cat4 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Chinois',
            'idType' => $type2
        ]);
        $cat5 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Indien',
            'idType' => $type2
        ]);
        $cat6 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Kebab',
            'idType' => $type2
        ]);
        $cat7 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Mexicain',
            'idType' => $type2
        ]);
        $cat8 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Chevaline',
            'idType' => $type8
        ]);
        $cat9 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Brasserie',
            'idType' => $type11
        ]);
        $cat10 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Café',
            'idType' => $type11
        ]);
        $cat11 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Salon de thé',
            'idType' => $type11
        ]);
        $cat12 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Bar',
            'idType' => $type11
        ]);
        $cat13 = DB::table('categories')->insertGetId([
            'libCategorie' => 'Cave',
            'idType' => $type11
        ]);

        /**Magasin**/
        //factory(App\Magasin::class, 200)->create();



        /**Promotion
        $promo1 = DB::table('promotions')->insertGetId([
            'dateDebutPromo' => '2019-02-10',
            'dateFinPromo' => '2019-02-24',
            'libPromo' => 'C\'est la Saint-Valentin ! Alors profiter de -20% sur tous les accessoires pour lui et pour elle',
            'etatPromo' => 1,
            'codePromo' => 'STV',
            'codeAvisPromo' => '5pY',
            'idMagasin' => $mag2
        ]);

        $promo2 = DB::table('promotions')->insertGetId([
            'dateDebutPromo' => '2019-01-01',
            'dateFinPromo' => '2019-01-13',
            'libPromo' => 'Toutes les pizzas sont à -20%',
            'etatPromo' => 0,
            'codePromo' => 'PIZ',
            'codeAvisPromo' => 'B9P',
            'idMagasin' => $mag5
        ]);

        $promo3 = DB::table('promotions')->insertGetId([
            'dateDebutPromo' => '2019-01-21',
            'dateFinPromo' => '2019-02-21',
            'libPromo' => 'GigaTacos à -10% pour les étudiants',
            'etatPromo' => 1,
            'codePromo' => 'GT3',
            'codeAvisPromo' => '89P',
            'idMagasin' => $mag4
        ]);

        /**Adhésion
        DB::table('adhesions')->insertGetId([
            'Promotion_idPromo' => $promo1,
            'Internaute_idInternaute' => $internaute2,
            'noteAdhesion' => 4,
            'commentaireAdhesion' => 'La bière était trop bonnes, vive la Guiness!'
        ]);

        DB::table('adhesions')->insertGetId([
            'Promotion_idPromo' => $promo2,
            'Internaute_idInternaute' => $internaute1,
            'noteAdhesion' => 1,
            'commentaireAdhesion' => 'De toute façon elles sont pas bonnes les pizzas'
        ]);

        DB::table('adhesions')->insertGetId([
            'Promotion_idPromo' => $promo1,
            'Internaute_idInternaute' => $internaute3,
            'noteAdhesion' => 3,
            'commentaireAdhesion' => 'Cool'
        ]);**/

    }
}
