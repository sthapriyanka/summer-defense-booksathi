<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin@123'),
                'role' => 'admin',
                'address' => 'Kathmandu, Nepal'
            ],
            [
                'name' => 'Rohit Shakya',
                'email' => 'shakyarohit2022@gmail.com',
                'password' => bcrypt('rohit@123'),
                'role' => 'user',
                'address' => 'Bhaktapur, Nepal'
            ],
            [
                'name' => 'Priyanka Shrestha',
                'email' => '021bim033@sxc.edu.np',
                'password' => bcrypt('priyanka@123'),
                'role' => 'user',
                'address' => 'Lalitpur, Nepal'
            ],
            [
                'name' => 'Himani Gurung',
                'email' => 'himanigrg9863@gmail.com',
                'password' => bcrypt('himani@123'),
                'role' => 'user',
                'address' => 'Pokhara, Nepal'
            ],
            [
                'name' => 'Pranjal Raj Mainali',
                'email' => 'pranjal2022@gmail.com',
                'password' => bcrypt('pranjal@123'),
                'role' => 'user',
                'address' => 'Chitwan, Nepal'
            ],
            [
                'name' => 'Neha Shrestha',
                'email' => 'nehastha@gmail.com',
                'password' => bcrypt('neha@123'),
                'role' => 'user',
                'address' => 'Biratnagar, Nepal'
            ],
            [
                'name' => 'Dipesh Dangol',
                'email' => 'dipeshdangol@gmail.com',
                'password' => bcrypt('dipesh@123'),
                'role' => 'user',
                'address' => 'Kirtipur, Nepal'
            ],
            [
                'name' => 'Prakash Saput',
                'email' => 'prakashsaput@gmail.com',
                'password' => bcrypt('prakash@123'),
                'role' => 'user',
                'address' => 'Butwal, Nepal'
            ],
            [
                'name' => 'Amit Dong',
                'email' => 'amitdong@gmail.com',
                'password' => bcrypt('amit@123'),
                'role' => 'user',
                'address' => 'Dharan, Nepal'
            ],
            [
                'name' => 'Supriya Mahat',
                'email' => 'supriyamahat@gmail.com',
                'password' => bcrypt('supriya@123'),
                'role' => 'user',
                'address' => 'Janakpur, Nepal'
            ],
            [
                'name' => 'Kusum Magar',
                'email' => 'kusummagar@gmail.com',
                'password' => bcrypt('kusum@123'),
                'role' => 'user',
                'address' => 'Hetauda, Nepal'
            ],
            [
                'name' => 'Janak Raj Poudel',
                'email' => 'janakrajpoudel@gmail.com',
                'password' => bcrypt('janak@123'),
                'role' => 'user',
                'address' => 'Birgunj, Nepal'
            ],
            [
                'name' => 'Kamal Rai',
                'email' => 'kamalrai@gmail.com',
                'password' => bcrypt('kamal@123'),
                'role' => 'user',
                'address' => 'Dhangadhi, Nepal'
            ],
            [
                'name' => 'Wangden Sherpa',
                'email' => 'wangdensherpa@gmail.com',
                'password' => bcrypt('wangden@123'),
                'role' => 'user',
                'address' => 'Namche Bazaar, Nepal'
            ],
            [
                'name' => 'Salman Khan',
                'email' => 'salmankhan@gmail.com',
                'password' => bcrypt('salman@123'),
                'role' => 'user',
                'address' => 'Kathmandu, Nepal'
            ],
            [
                'name' => 'Aishwarya Rai',
                'email' => 'aishwaryarai@gmail.com',
                'password' => bcrypt('aishwarya@123'),
                'role' => 'user',
                'address' => 'Lalitpur, Nepal'
            ],
            [
                'name' => 'Robert Downey Jr.',
                'email' => 'robertdowneyjr@gmail.com',
                'password' => bcrypt('robert@123'),
                'role' => 'user',
                'address' => 'Thamel, Kathmandu, Nepal'
            ],
            [
                'name' => 'Shah Rukh Khan',
                'email' => 'shahrukhkhan@gmail.com',
                'password' => bcrypt('shahrukh@123'),
                'role' => 'user',
                'address' => 'Bhaktapur, Nepal'
            ],
            [
                'name' => 'Emma Watson',
                'email' => 'emmawatson@gmail.com',
                'password' => bcrypt('emma@123'),
                'role' => 'user',
                'address' => 'Pokhara, Nepal'
            ],
            [
                'name' => 'Priyanka Chopra',
                'email' => 'priyankachopra@gmail.com',
                'password' => bcrypt('priyanka@123'),
                'role' => 'user',
                'address' => 'Lalitpur, Nepal'
            ],
            [
                'name' => 'AJ Lee',
                'email' => 'ajlee@gmail.com',
                'password' => bcrypt('aj@123'),
                'role' => 'user',
                'address' => 'Kathmandu, Nepal'
            ],
            [
                'name' => 'William Shatner',
                'email' => 'williamshatner@gmail.com',
                'password' => bcrypt('william@123'),
                'role' => 'user',
                'address' => 'Bhaktapur, Nepal'
            ],
            // Additional 200 users start here
            [
                'name' => 'Naruto Uzumaki',
                'email' => 'naruto.uzumaki@gmail.com',
                'password' => bcrypt('naruto@123'),
                'role' => 'user',
                'address' => 'Dhulikhel, Nepal'
            ],
            [
                'name' => 'Roronoa Zoro',
                'email' => 'roronoa.zoro@gmail.com',
                'password' => bcrypt('zoro@123'),
                'role' => 'user',
                'address' => 'Gorkha, Nepal'
            ],
            [
                'name' => 'Monkey D. Luffy',
                'email' => 'monkey.luffy@gmail.com',
                'password' => bcrypt('luffy@123'),
                'role' => 'user',
                'address' => 'Mustang, Nepal'
            ],
            [
                'name' => 'Sasuke Uchiha',
                'email' => 'sasuke.uchiha@gmail.com',
                'password' => bcrypt('sasuke@123'),
                'role' => 'user',
                'address' => 'Bandipur, Nepal'
            ],
            [
                'name' => 'Chris Evans',
                'email' => 'chris.evans@gmail.com',
                'password' => bcrypt('chris@123'),
                'role' => 'user',
                'address' => 'New Road, Kathmandu, Nepal'
            ],
            [
                'name' => 'Chris Hemsworth',
                'email' => 'chris.hemsworth@gmail.com',
                'password' => bcrypt('thor@123'),
                'role' => 'user',
                'address' => 'Baneshwor, Kathmandu, Nepal'
            ],
            [
                'name' => 'Scarlett Johansson',
                'email' => 'scarlett.johansson@gmail.com',
                'password' => bcrypt('scarlett@123'),
                'role' => 'user',
                'address' => 'Pulchowk, Lalitpur, Nepal'
            ],
            [
                'name' => 'Mark Ruffalo',
                'email' => 'mark.ruffalo@gmail.com',
                'password' => bcrypt('hulk@123'),
                'role' => 'user',
                'address' => 'Patan, Nepal'
            ],
            [
                'name' => 'Jeremy Renner',
                'email' => 'jeremy.renner@gmail.com',
                'password' => bcrypt('hawkeye@123'),
                'role' => 'user',
                'address' => 'Budhanilkantha, Nepal'
            ],
            [
                'name' => 'Aamir Khan',
                'email' => 'aamir.khan@gmail.com',
                'password' => bcrypt('aamir@123'),
                'role' => 'user',
                'address' => 'Maharajgunj, Kathmandu, Nepal'
            ],
            [
                'name' => 'Deepika Padukone',
                'email' => 'deepika.padukone@gmail.com',
                'password' => bcrypt('deepika@123'),
                'role' => 'user',
                'address' => 'Jawalakhel, Lalitpur, Nepal'
            ],
            [
                'name' => 'Virat Kohli',
                'email' => 'virat.kohli@gmail.com',
                'password' => bcrypt('virat@123'),
                'role' => 'user',
                'address' => 'Dillibazar, Kathmandu, Nepal'
            ],
            [
                'name' => 'MS Dhoni',
                'email' => 'ms.dhoni@gmail.com',
                'password' => bcrypt('dhoni@123'),
                'role' => 'user',
                'address' => 'Chabahil, Kathmandu, Nepal'
            ],
            [
                'name' => 'Akira Kurosawa',
                'email' => 'akira.kurosawa@gmail.com',
                'password' => bcrypt('akira@123'),
                'role' => 'user',
                'address' => 'Kapan, Kathmandu, Nepal'
            ],
            [
                'name' => 'Haruki Murakami',
                'email' => 'haruki.murakami@gmail.com',
                'password' => bcrypt('haruki@123'),
                'role' => 'user',
                'address' => 'Balaju, Kathmandu, Nepal'
            ],
            [
                'name' => 'Yuki Tanaka',
                'email' => 'yuki.tanaka@gmail.com',
                'password' => bcrypt('yuki@123'),
                'role' => 'user',
                'address' => 'Tokha, Kathmandu, Nepal'
            ],
            [
                'name' => 'Hiroshi Sato',
                'email' => 'hiroshi.sato@gmail.com',
                'password' => bcrypt('hiroshi@123'),
                'role' => 'user',
                'address' => 'Gongabu, Kathmandu, Nepal'
            ],
            [
                'name' => 'Leonardo DiCaprio',
                'email' => 'leonardo.dicaprio@gmail.com',
                'password' => bcrypt('leonardo@123'),
                'role' => 'user',
                'address' => 'Lazimpat, Kathmandu, Nepal'
            ],
            [
                'name' => 'Brad Pitt',
                'email' => 'brad.pitt@gmail.com',
                'password' => bcrypt('brad@123'),
                'role' => 'user',
                'address' => 'Durbarmarg, Kathmandu, Nepal'
            ],
            [
                'name' => 'Tom Hanks',
                'email' => 'tom.hanks@gmail.com',
                'password' => bcrypt('tom@123'),
                'role' => 'user',
                'address' => 'Naxal, Kathmandu, Nepal'
            ],
            [
                'name' => 'Will Smith',
                'email' => 'will.smith@gmail.com',
                'password' => bcrypt('will@123'),
                'role' => 'user',
                'address' => 'Anamnagar, Kathmandu, Nepal'
            ],
            [
                'name' => 'Angelina Jolie',
                'email' => 'angelina.jolie@gmail.com',
                'password' => bcrypt('angelina@123'),
                'role' => 'user',
                'address' => 'Sankhamul, Kathmandu, Nepal'
            ],
            [
                'name' => 'Jennifer Lawrence',
                'email' => 'jennifer.lawrence@gmail.com',
                'password' => bcrypt('jennifer@123'),
                'role' => 'user',
                'address' => 'Kalanki, Kathmandu, Nepal'
            ],
            [
                'name' => 'Ryan Reynolds',
                'email' => 'ryan.reynolds@gmail.com',
                'password' => bcrypt('ryan@123'),
                'role' => 'user',
                'address' => 'Ring Road, Kathmandu, Nepal'
            ],
            [
                'name' => 'Hugh Jackman',
                'email' => 'hugh.jackman@gmail.com',
                'password' => bcrypt('hugh@123'),
                'role' => 'user',
                'address' => 'Sinamangal, Kathmandu, Nepal'
            ],
            [
                'name' => 'Rajesh Hamal',
                'email' => 'rajesh.hamal@gmail.com',
                'password' => bcrypt('rajesh@123'),
                'role' => 'user',
                'address' => 'Bhaktapur Durbar Square, Nepal'
            ],
            [
                'name' => 'Rekha Thapa',
                'email' => 'rekha.thapa@gmail.com',
                'password' => bcrypt('rekha@123'),
                'role' => 'user',
                'address' => 'Mohan Pokhari, Kathmandu, Nepal'
            ],
            [
                'name' => 'Biraj Bhatta',
                'email' => 'biraj.bhatta@gmail.com',
                'password' => bcrypt('biraj@123'),
                'role' => 'user',
                'address' => 'Sukedhara, Kathmandu, Nepal'
            ],
            [
                'name' => 'Dayahang Rai',
                'email' => 'dayahang.rai@gmail.com',
                'password' => bcrypt('dayahang@123'),
                'role' => 'user',
                'address' => 'Bhotebahal, Kathmandu, Nepal'
            ],
            [
                'name' => 'Karma Shakya',
                'email' => 'karma.shakya@gmail.com',
                'password' => bcrypt('karma@123'),
                'role' => 'user',
                'address' => 'Swayambhu, Kathmandu, Nepal'
            ],
            [
                'name' => 'Saugat Malla',
                'email' => 'saugat.malla@gmail.com',
                'password' => bcrypt('saugat@123'),
                'role' => 'user',
                'address' => 'Baneshwor, Kathmandu, Nepal'
            ],
            [
                'name' => 'Goku Son',
                'email' => 'goku.son@gmail.com',
                'password' => bcrypt('goku@123'),
                'role' => 'user',
                'address' => 'Sankhu, Kathmandu, Nepal'
            ],
            [
                'name' => 'Vegeta Prince',
                'email' => 'vegeta.prince@gmail.com',
                'password' => bcrypt('vegeta@123'),
                'role' => 'user',
                'address' => 'Changunarayan, Nepal'
            ],
            [
                'name' => 'Ichigo Kurosaki',
                'email' => 'ichigo.kurosaki@gmail.com',
                'password' => bcrypt('ichigo@123'),
                'role' => 'user',
                'address' => 'Thankot, Kathmandu, Nepal'
            ],
            [
                'name' => 'Edward Elric',
                'email' => 'edward.elric@gmail.com',
                'password' => bcrypt('edward@123'),
                'role' => 'user',
                'address' => 'Goldhunga, Kathmandu, Nepal'
            ],
            [
                'name' => 'Levi Ackerman',
                'email' => 'levi.ackerman@gmail.com',
                'password' => bcrypt('levi@123'),
                'role' => 'user',
                'address' => 'Kirtipur, Nepal'
            ],
            [
                'name' => 'Eren Yeager',
                'email' => 'eren.yeager@gmail.com',
                'password' => bcrypt('eren@123'),
                'role' => 'user',
                'address' => 'Chobar, Kathmandu, Nepal'
            ],
            [
                'name' => 'Light Yagami',
                'email' => 'light.yagami@gmail.com',
                'password' => bcrypt('light@123'),
                'role' => 'user',
                'address' => 'Dakshinkali, Nepal'
            ],
            [
                'name' => 'L Lawliet',
                'email' => 'l.lawliet@gmail.com',
                'password' => bcrypt('lawliet@123'),
                'role' => 'user',
                'address' => 'Pharping, Nepal'
            ],
            [
                'name' => 'Natsu Dragneel',
                'email' => 'natsu.dragneel@gmail.com',
                'password' => bcrypt('natsu@123'),
                'role' => 'user',
                'address' => 'Champadevi, Nepal'
            ],
            [
                'name' => 'Lucy Heartfilia',
                'email' => 'lucy.heartfilia@gmail.com',
                'password' => bcrypt('lucy@123'),
                'role' => 'user',
                'address' => 'Hattiban, Kathmandu, Nepal'
            ],
            [
                'name' => 'Tanjiro Kamado',
                'email' => 'tanjiro.kamado@gmail.com',
                'password' => bcrypt('tanjiro@123'),
                'role' => 'user',
                'address' => 'Nagarjun, Kathmandu, Nepal'
            ],
            [
                'name' => 'Nezuko Kamado',
                'email' => 'nezuko.kamado@gmail.com',
                'password' => bcrypt('nezuko@123'),
                'role' => 'user',
                'address' => 'Shivapuri, Nepal'
            ],
            [
                'name' => 'Saitama',
                'email' => 'saitama.onepunch@gmail.com',
                'password' => bcrypt('saitama@123'),
                'role' => 'user',
                'address' => 'Budhanilkantha, Nepal'
            ],
            [
                'name' => 'Genos',
                'email' => 'genos.cyborg@gmail.com',
                'password' => bcrypt('genos@123'),
                'role' => 'user',
                'address' => 'Sundarijal, Nepal'
            ],
            [
                'name' => 'Monkey D. Dragon',
                'email' => 'monkey.dragon@gmail.com',
                'password' => bcrypt('dragon@123'),
                'role' => 'user',
                'address' => 'Nagarkot, Nepal'
            ],
            [
                'name' => 'Portgas D. Ace',
                'email' => 'portgas.ace@gmail.com',
                'password' => bcrypt('ace@123'),
                'role' => 'user',
                'address' => 'Daman, Nepal'
            ],
            [
                'name' => 'Vinsmoke Sanji',
                'email' => 'vinsmoke.sanji@gmail.com',
                'password' => bcrypt('sanji@123'),
                'role' => 'user',
                'address' => 'Palpa, Nepal'
            ],
            [
                'name' => 'Nico Robin',
                'email' => 'nico.robin@gmail.com',
                'password' => bcrypt('robin@123'),
                'role' => 'user',
                'address' => 'Tansen, Nepal'
            ],
            [
                'name' => 'Tony Chopper',
                'email' => 'tony.chopper@gmail.com',
                'password' => bcrypt('chopper@123'),
                'role' => 'user',
                'address' => 'Syangja, Nepal'
            ],
            [
                'name' => 'Franky',
                'email' => 'franky.cyborg@gmail.com',
                'password' => bcrypt('franky@123'),
                'role' => 'user',
                'address' => 'Kaski, Nepal'
            ],
            [
                'name' => 'Brook',
                'email' => 'brook.musician@gmail.com',
                'password' => bcrypt('brook@123'),
                'role' => 'user',
                'address' => 'Baglung, Nepal'
            ],
            [
                'name' => 'Jinbe',
                'email' => 'jinbe.fishman@gmail.com',
                'password' => bcrypt('jinbe@123'),
                'role' => 'user',
                'address' => 'Myagdi, Nepal'
            ],
            [
                'name' => 'Anthony Stark',
                'email' => 'anthony.stark@gmail.com',
                'password' => bcrypt('stark@123'),
                'role' => 'user',
                'address' => 'Banepa, Nepal'
            ],
            [
                'name' => 'Steve Rogers',
                'email' => 'steve.rogers@gmail.com',
                'password' => bcrypt('steve@123'),
                'role' => 'user',
                'address' => 'Panauti, Nepal'
            ],
            [
                'name' => 'Thor Odinson',
                'email' => 'thor.odinson@gmail.com',
                'password' => bcrypt('odinson@123'),
                'role' => 'user',
                'address' => 'Dolakha, Nepal'
            ],
            [
                'name' => 'Bruce Banner',
                'email' => 'bruce.banner@gmail.com',
                'password' => bcrypt('banner@123'),
                'role' => 'user',
                'address' => 'Sindhuli, Nepal'
            ],
            [
                'name' => 'Natasha Romanoff',
                'email' => 'natasha.romanoff@gmail.com',
                'password' => bcrypt('natasha@123'),
                'role' => 'user',
                'address' => 'Ramechhap, Nepal'
            ],
            [
                'name' => 'Clint Barton',
                'email' => 'clint.barton@gmail.com',
                'password' => bcrypt('clint@123'),
                'role' => 'user',
                'address' => 'Okhaldhunga, Nepal'
            ],
            [
                'name' => 'Stephen Strange',
                'email' => 'stephen.strange@gmail.com',
                'password' => bcrypt('strange@123'),
                'role' => 'user',
                'address' => 'Solukhumbu, Nepal'
            ],
            [
                'name' => 'Peter Parker',
                'email' => 'peter.parker@gmail.com',
                'password' => bcrypt('peter@123'),
                'role' => 'user',
                'address' => 'Khotang, Nepal'
            ],
            [
                'name' => 'Wanda Maximoff',
                'email' => 'wanda.maximoff@gmail.com',
                'password' => bcrypt('wanda@123'),
                'role' => 'user',
                'address' => 'Bhojpur, Nepal'
            ],
            [
                'name' => 'Pietro Maximoff',
                'email' => 'pietro.maximoff@gmail.com',
                'password' => bcrypt('pietro@123'),
                'role' => 'user',
                'address' => 'Dhankuta, Nepal'
            ],
            [
                'name' => 'T Challa',
                'email' => 't.challa@gmail.com',
                'password' => bcrypt('tchalla@123'),
                'role' => 'user',
                'address' => 'Terhathum, Nepal'
            ],
            [
                'name' => 'Scott Lang',
                'email' => 'scott.lang@gmail.com',
                'password' => bcrypt('scott@123'),
                'role' => 'user',
                'address' => 'Sankhuwasabha, Nepal'
            ],
            [
                'name' => 'Carol Danvers',
                'email' => 'carol.danvers@gmail.com',
                'password' => bcrypt('carol@123'),
                'role' => 'user',
                'address' => 'Taplejung, Nepal'
            ],
            [
                'name' => 'Sam Wilson',
                'email' => 'sam.wilson@gmail.com',
                'password' => bcrypt('sam@123'),
                'role' => 'user',
                'address' => 'Panchthar, Nepal'
            ],
            [
                'name' => 'Bucky Barnes',
                'email' => 'bucky.barnes@gmail.com',
                'password' => bcrypt('bucky@123'),
                'role' => 'user',
                'address' => 'Ilam, Nepal'
            ],
            [
                'name' => 'Nick Fury',
                'email' => 'nick.fury@gmail.com',
                'password' => bcrypt('fury@123'),
                'role' => 'user',
                'address' => 'Jhapa, Nepal'
            ],
            [
                'name' => 'Maria Hill',
                'email' => 'maria.hill@gmail.com',
                'password' => bcrypt('maria@123'),
                'role' => 'user',
                'address' => 'Morang, Nepal'
            ],
            [
                'name' => 'Phil Coulson',
                'email' => 'phil.coulson@gmail.com',
                'password' => bcrypt('phil@123'),
                'role' => 'user',
                'address' => 'Sunsari, Nepal'
            ],
            [
                'name' => 'James Rhodes',
                'email' => 'james.rhodes@gmail.com',
                'password' => bcrypt('rhodes@123'),
                'role' => 'user',
                'address' => 'Saptari, Nepal'
            ],
            [
                'name' => 'Pepper Potts',
                'email' => 'pepper.potts@gmail.com',
                'password' => bcrypt('pepper@123'),
                'role' => 'user',
                'address' => 'Siraha, Nepal'
            ],
            [
                'name' => 'Happy Hogan',
                'email' => 'happy.hogan@gmail.com',
                'password' => bcrypt('happy@123'),
                'role' => 'user',
                'address' => 'Dhanusha, Nepal'
            ],
            [
                'name' => 'Loki Laufeyson',
                'email' => 'loki.laufeyson@gmail.com',
                'password' => bcrypt('loki@123'),
                'role' => 'user',
                'address' => 'Mahottari, Nepal'
            ],
            [
                'name' => 'Heimdall',
                'email' => 'heimdall.asgard@gmail.com',
                'password' => bcrypt('heimdall@123'),
                'role' => 'user',
                'address' => 'Sarlahi, Nepal'
            ],
            [
                'name' => 'Odin Allfather',
                'email' => 'odin.allfather@gmail.com',
                'password' => bcrypt('odin@123'),
                'role' => 'user',
                'address' => 'Rautahat, Nepal'
            ],
            [
                'name' => 'Frigga',
                'email' => 'frigga.asgard@gmail.com',
                'password' => bcrypt('frigga@123'),
                'role' => 'user',
                'address' => 'Bara, Nepal'
            ],
            [
                'name' => 'Jane Foster',
                'email' => 'jane.foster@gmail.com',
                'password' => bcrypt('jane@123'),
                'role' => 'user',
                'address' => 'Parsa, Nepal'
            ],
            [
                'name' => 'Darcy Lewis',
                'email' => 'darcy.lewis@gmail.com',
                'password' => bcrypt('darcy@123'),
                'role' => 'user',
                'address' => 'Chitwan, Nepal'
            ],
            [
                'name' => 'Erik Selvig',
                'email' => 'erik.selvig@gmail.com',
                'password' => bcrypt('erik@123'),
                'role' => 'user',
                'address' => 'Nawalpur, Nepal'
            ],
            [
                'name' => 'Gamora',
                'email' => 'gamora.guardian@gmail.com',
                'password' => bcrypt('gamora@123'),
                'role' => 'user',
                'address' => 'Gorkha, Nepal'
            ],
            [
                'name' => 'Peter Quill',
                'email' => 'peter.quill@gmail.com',
                'password' => bcrypt('starlord@123'),
                'role' => 'user',
                'address' => 'Lamjung, Nepal'
            ],
            [
                'name' => 'Rocket Raccoon',
                'email' => 'rocket.raccoon@gmail.com',
                'password' => bcrypt('rocket@123'),
                'role' => 'user',
                'address' => 'Tanahun, Nepal'
            ],
            [
                'name' => 'Groot',
                'email' => 'groot.tree@gmail.com',
                'password' => bcrypt('groot@123'),
                'role' => 'user',
                'address' => 'Syangja, Nepal'
            ],
            [
                'name' => 'Drax Destroyer',
                'email' => 'drax.destroyer@gmail.com',
                'password' => bcrypt('drax@123'),
                'role' => 'user',
                'address' => 'Kaski, Nepal'
            ],
            [
                'name' => 'Mantis',
                'email' => 'mantis.guardian@gmail.com',
                'password' => bcrypt('mantis@123'),
                'role' => 'user',
                'address' => 'Manang, Nepal'
            ],
            [
                'name' => 'Nebula',
                'email' => 'nebula.guardian@gmail.com',
                'password' => bcrypt('nebula@123'),
                'role' => 'user',
                'address' => 'Mustang, Nepal'
            ],
            [
                'name' => 'Yondu Udonta',
                'email' => 'yondu.udonta@gmail.com',
                'password' => bcrypt('yondu@123'),
                'role' => 'user',
                'address' => 'Myagdi, Nepal'
            ],
            [
                'name' => 'Kraglin Obfonteri',
                'email' => 'kraglin.obfonteri@gmail.com',
                'password' => bcrypt('kraglin@123'),
                'role' => 'user',
                'address' => 'Baglung, Nepal'
            ],
            [
                'name' => 'Vision',
                'email' => 'vision.android@gmail.com',
                'password' => bcrypt('vision@123'),
                'role' => 'user',
                'address' => 'Parbat, Nepal'
            ],
            [
                'name' => 'Rhodey',
                'email' => 'rhodey.warmachine@gmail.com',
                'password' => bcrypt('rhodey@123'),
                'role' => 'user',
                'address' => 'Gulmi, Nepal'
            ],
            [
                'name' => 'Hope Van Dyne',
                'email' => 'hope.vandyne@gmail.com',
                'password' => bcrypt('hope@123'),
                'role' => 'user',
                'address' => 'Arghakhanchi, Nepal'
            ],
            [
                'name' => 'Hank Pym',
                'email' => 'hank.pym@gmail.com',
                'password' => bcrypt('hank@123'),
                'role' => 'user',
                'address' => 'Kapilvastu, Nepal'
            ],
            [
                'name' => 'Janet Van Dyne',
                'email' => 'janet.vandyne@gmail.com',
                'password' => bcrypt('janet@123'),
                'role' => 'user',
                'address' => 'Rupandehi, Nepal'
            ],
            [
                'name' => 'Shuri',
                'email' => 'shuri.wakanda@gmail.com',
                'password' => bcrypt('shuri@123'),
                'role' => 'user',
                'address' => 'Palpa, Nepal'
            ],
            [
                'name' => 'Okoye',
                'email' => 'okoye.wakanda@gmail.com',
                'password' => bcrypt('okoye@123'),
                'role' => 'user',
                'address' => 'Nawalparasi, Nepal'
            ],
            [
                'name' => 'Nakia',
                'email' => 'nakia.wakanda@gmail.com',
                'password' => bcrypt('nakia@123'),
                'role' => 'user',
                'address' => 'Dang, Nepal'
            ],
            [
                'name' => 'Ramonda',
                'email' => 'ramonda.wakanda@gmail.com',
                'password' => bcrypt('ramonda@123'),
                'role' => 'user',
                'address' => 'Banke, Nepal'
            ],
            [
                'name' => 'Mbaku',
                'email' => 'mbaku.wakanda@gmail.com',
                'password' => bcrypt('mbaku@123'),
                'role' => 'user',
                'address' => 'Bardiya, Nepal'
            ],
            [
                'name' => 'Killmonger',
                'email' => 'killmonger.wakanda@gmail.com',
                'password' => bcrypt('killmonger@123'),
                'role' => 'user',
                'address' => 'Surkhet, Nepal'
            ],
            [
                'name' => 'Rajinikanth',
                'email' => 'rajinikanth.superstar@gmail.com',
                'password' => bcrypt('rajini@123'),
                'role' => 'user',
                'address' => 'Dailekh, Nepal'
            ],
            [
                'name' => 'Kamal Haasan',
                'email' => 'kamal.haasan@gmail.com',
                'password' => bcrypt('kamal@123'),
                'role' => 'user',
                'address' => 'Jajarkot, Nepal'
            ],
            [
                'name' => 'Vijay Thalapathy',
                'email' => 'vijay.thalapathy@gmail.com',
                'password' => bcrypt('vijay@123'),
                'role' => 'user',
                'address' => 'Dolpa, Nepal'
            ],
            [
                'name' => 'Ajith Kumar',
                'email' => 'ajith.kumar@gmail.com',
                'password' => bcrypt('ajith@123'),
                'role' => 'user',
                'address' => 'Jumla, Nepal'
            ],
            [
                'name' => 'Suriya Sivakumar',
                'email' => 'suriya.sivakumar@gmail.com',
                'password' => bcrypt('suriya@123'),
                'role' => 'user',
                'address' => 'Kalikot, Nepal'
            ],
            [
                'name' => 'Dhanush',
                'email' => 'dhanush.actor@gmail.com',
                'password' => bcrypt('dhanush@123'),
                'role' => 'user',
                'address' => 'Mugu, Nepal'
            ],
            [
                'name' => 'Samantha Ruth Prabhu',
                'email' => 'samantha.prabhu@gmail.com',
                'password' => bcrypt('samantha@123'),
                'role' => 'user',
                'address' => 'Humla, Nepal'
            ],
            [
                'name' => 'Trisha Krishnan',
                'email' => 'trisha.krishnan@gmail.com',
                'password' => bcrypt('trisha@123'),
                'role' => 'user',
                'address' => 'Bajura, Nepal'
            ],
            [
                'name' => 'Nayanthara',
                'email' => 'nayanthara.actress@gmail.com',
                'password' => bcrypt('nayanthara@123'),
                'role' => 'user',
                'address' => 'Bajhang, Nepal'
            ],
            [
                'name' => 'Keerthy Suresh',
                'email' => 'keerthy.suresh@gmail.com',
                'password' => bcrypt('keerthy@123'),
                'role' => 'user',
                'address' => 'Achham, Nepal'
            ],
            [
                'name' => 'Allu Arjun',
                'email' => 'allu.arjun@gmail.com',
                'password' => bcrypt('allu@123'),
                'role' => 'user',
                'address' => 'Doti, Nepal'
            ],
            [
                'name' => 'Mahesh Babu',
                'email' => 'mahesh.babu@gmail.com',
                'password' => bcrypt('mahesh@123'),
                'role' => 'user',
                'address' => 'Kailali, Nepal'
            ],
            [
                'name' => 'Ram Charan',
                'email' => 'ram.charan@gmail.com',
                'password' => bcrypt('ramcharan@123'),
                'role' => 'user',
                'address' => 'Kanchanpur, Nepal'
            ],
            [
                'name' => 'Jr NTR',
                'email' => 'jr.ntr@gmail.com',
                'password' => bcrypt('jrntr@123'),
                'role' => 'user',
                'address' => 'Dadeldhura, Nepal'
            ],
            [
                'name' => 'Prabhas',
                'email' => 'prabhas.actor@gmail.com',
                'password' => bcrypt('prabhas@123'),
                'role' => 'user',
                'address' => 'Baitadi, Nepal'
            ],
            [
                'name' => 'Rana Daggubati',
                'email' => 'rana.daggubati@gmail.com',
                'password' => bcrypt('rana@123'),
                'role' => 'user',
                'address' => 'Darchula, Nepal'
            ],
            [
                'name' => 'Yash',
                'email' => 'yash.kgf@gmail.com',
                'password' => bcrypt('yash@123'),
                'role' => 'user',
                'address' => 'Kathmandu Valley, Nepal'
            ],
            [
                'name' => 'Puneeth Rajkumar',
                'email' => 'puneeth.rajkumar@gmail.com',
                'password' => bcrypt('puneeth@123'),
                'role' => 'user',
                'address' => 'Boudhanath, Kathmandu, Nepal'
            ],
            [
                'name' => 'Sudeep',
                'email' => 'sudeep.actor@gmail.com',
                'password' => bcrypt('sudeep@123'),
                'role' => 'user',
                'address' => 'Pashupatinath, Kathmandu, Nepal'
            ],
            [
                'name' => 'Darshan Thoogudeepa',
                'email' => 'darshan.thoogudeepa@gmail.com',
                'password' => bcrypt('darshan@123'),
                'role' => 'user',
                'address' => 'Swayambhunath, Kathmandu, Nepal'
            ],
            [
                'name' => 'Rakshit Shetty',
                'email' => 'rakshit.shetty@gmail.com',
                'password' => bcrypt('rakshit@123'),
                'role' => 'user',
                'address' => 'Changunarayan, Bhaktapur, Nepal'
            ],
            [
                'name' => 'Mammootty',
                'email' => 'mammootty.actor@gmail.com',
                'password' => bcrypt('mammootty@123'),
                'role' => 'user',
                'address' => 'Nyatapola, Bhaktapur, Nepal'
            ],
            [
                'name' => 'Mohanlal',
                'email' => 'mohanlal.actor@gmail.com',
                'password' => bcrypt('mohanlal@123'),
                'role' => 'user',
                'address' => 'Dattatreya Temple, Bhaktapur, Nepal'
            ],
            [
                'name' => 'Fahadh Faasil',
                'email' => 'fahadh.faasil@gmail.com',
                'password' => bcrypt('fahadh@123'),
                'role' => 'user',
                'address' => 'Patan Durbar Square, Nepal'
            ],
            [
                'name' => 'Prithviraj Sukumaran',
                'email' => 'prithviraj.sukumaran@gmail.com',
                'password' => bcrypt('prithviraj@123'),
                'role' => 'user',
                'address' => 'Mahabouddha, Lalitpur, Nepal'
            ],
            [
                'name' => 'Dulquer Salmaan',
                'email' => 'dulquer.salmaan@gmail.com',
                'password' => bcrypt('dulquer@123'),
                'role' => 'user',
                'address' => 'Godavari, Lalitpur, Nepal'
            ],
            [
                'name' => 'Nivin Pauly',
                'email' => 'nivin.pauly@gmail.com',
                'password' => bcrypt('nivin@123'),
                'role' => 'user',
                'address' => 'Chapagaun, Lalitpur, Nepal'
            ],
            [
                'name' => 'Tovino Thomas',
                'email' => 'tovino.thomas@gmail.com',
                'password' => bcrypt('tovino@123'),
                'role' => 'user',
                'address' => 'Bungamati, Lalitpur, Nepal'
            ],
            [
                'name' => 'Asif Ali',
                'email' => 'asif.ali@gmail.com',
                'password' => bcrypt('asif@123'),
                'role' => 'user',
                'address' => 'Khokana, Lalitpur, Nepal'
            ],
            [
                'name' => 'Nayanthara',
                'email' => 'nayanthara.kerala@gmail.com',
                'password' => bcrypt('nayanthara2@123'),
                'role' => 'user',
                'address' => 'Sankhu, Kathmandu, Nepal'
            ],
            [
                'name' => 'Manju Warrier',
                'email' => 'manju.warrier@gmail.com',
                'password' => bcrypt('manju@123'),
                'role' => 'user',
                'address' => 'Thimi, Bhaktapur, Nepal'
            ],
            [
                'name' => 'Kunchacko Boban',
                'email' => 'kunchacko.boban@gmail.com',
                'password' => bcrypt('kunchacko@123'),
                'role' => 'user',
                'address' => 'Madhyapur Thimi, Nepal'
            ],
            [
                'name' => 'Indrajith Sukumaran',
                'email' => 'indrajith.sukumaran@gmail.com',
                'password' => bcrypt('indrajith@123'),
                'role' => 'user',
                'address' => 'Suryabinayak, Bhaktapur, Nepal'
            ],
            [
                'name' => 'Jayasurya',
                'email' => 'jayasurya.actor@gmail.com',
                'password' => bcrypt('jayasurya@123'),
                'role' => 'user',
                'address' => 'Nagarkot, Bhaktapur, Nepal'
            ],
            [
                'name' => 'Dileep',
                'email' => 'dileep.actor@gmail.com',
                'password' => bcrypt('dileep@123'),
                'role' => 'user',
                'address' => 'Changu Narayan, Nepal'
            ],
            [
                'name' => 'Kalidas Jayaram',
                'email' => 'kalidas.jayaram@gmail.com',
                'password' => bcrypt('kalidas@123'),
                'role' => 'user',
                'address' => 'Banepa, Kavre, Nepal'
            ],
            [
                'name' => 'Shane Nigam',
                'email' => 'shane.nigam@gmail.com',
                'password' => bcrypt('shane@123'),
                'role' => 'user',
                'address' => 'Panauti, Kavre, Nepal'
            ],
            [
                'name' => 'Vineeth Sreenivasan',
                'email' => 'vineeth.sreenivasan@gmail.com',
                'password' => bcrypt('vineeth@123'),
                'role' => 'user',
                'address' => 'Dhulikhel, Kavre, Nepal'
            ],
            [
                'name' => 'Alphonse Puthren',
                'email' => 'alphonse.puthren@gmail.com',
                'password' => bcrypt('alphonse@123'),
                'role' => 'user',
                'address' => 'Namobuddha, Kavre, Nepal'
            ],
            [
                'name' => 'Amal Neerad',
                'email' => 'amal.neerad@gmail.com',
                'password' => bcrypt('amal@123'),
                'role' => 'user',
                'address' => 'Khopasi, Kavre, Nepal'
            ],
            [
                'name' => 'Lijo Jose Pellissery',
                'email' => 'lijo.pellissery@gmail.com',
                'password' => bcrypt('lijo@123'),
                'role' => 'user',
                'address' => 'Balthali, Kavre, Nepal'
            ],
            [
                'name' => 'Dileesh Pothan',
                'email' => 'dileesh.pothan@gmail.com',
                'password' => bcrypt('dileesh@123'),
                'role' => 'user',
                'address' => 'Palanchowk, Kavre, Nepal'
            ],
            [
                'name' => 'Mahesh Narayanan',
                'email' => 'mahesh.narayanan@gmail.com',
                'password' => bcrypt('mahesh2@123'),
                'role' => 'user',
                'address' => 'Panchkhal, Kavre, Nepal'
            ],
            [
                'name' => 'Syam Pushkaran',
                'email' => 'syam.pushkaran@gmail.com',
                'password' => bcrypt('syam@123'),
                'role' => 'user',
                'address' => 'Bethanchowk, Kavre, Nepal'
            ],
            [
                'name' => 'Anjali Menon',
                'email' => 'anjali.menon@gmail.com',
                'password' => bcrypt('anjali@123'),
                'role' => 'user',
                'address' => 'Temal, Kavre, Nepal'
            ],
            [
                'name' => 'Geetu Mohandas',
                'email' => 'geetu.mohandas@gmail.com',
                'password' => bcrypt('geetu@123'),
                'role' => 'user',
                'address' => 'Roshi, Kavre, Nepal'
            ],
            [
                'name' => 'Rima Kallingal',
                'email' => 'rima.kallingal@gmail.com',
                'password' => bcrypt('rima@123'),
                'role' => 'user',
                'address' => 'Bhumlu, Kavre, Nepal'
            ],
            [
                'name' => 'Parvathy Thiruvothu',
                'email' => 'parvathy.thiruvothu@gmail.com',
                'password' => bcrypt('parvathy@123'),
                'role' => 'user',
                'address' => 'Timal, Kavrepalanchowk, Nepal'
            ],
            [
                'name' => 'Urvashi',
                'email' => 'urvashi.actress@gmail.com',
                'password' => bcrypt('urvashi@123'),
                'role' => 'user',
                'address' => 'Dolalghat, Kavrepalanchowk, Nepal'
            ],
            [
                'name' => 'Shobana',
                'email' => 'shobana.actress@gmail.com',
                'password' => bcrypt('shobana@123'),
                'role' => 'user',
                'address' => 'Khumaltar, Lalitpur, Nepal'
            ],
            [
                'name' => 'Meera Jasmine',
                'email' => 'meera.jasmine@gmail.com',
                'password' => bcrypt('meera@123'),
                'role' => 'user',
                'address' => 'Harisiddhi, Lalitpur, Nepal'
            ],
            [
                'name' => 'Kavya Madhavan',
                'email' => 'kavya.madhavan@gmail.com',
                'password' => bcrypt('kavya@123'),
                'role' => 'user',
                'address' => 'Lubhu, Lalitpur, Nepal'
            ],
            [
                'name' => 'Bhavana',
                'email' => 'bhavana.actress@gmail.com',
                'password' => bcrypt('bhavana@123'),
                'role' => 'user',
                'address' => 'Tikathali, Lalitpur, Nepal'
            ],
            [
                'name' => 'Nazriya Nazim',
                'email' => 'nazriya.nazim@gmail.com',
                'password' => bcrypt('nazriya@123'),
                'role' => 'user',
                'address' => 'Sunakothi, Lalitpur, Nepal'
            ],
            [
                'name' => 'Aishwarya Lekshmi',
                'email' => 'aishwarya.lekshmi@gmail.com',
                'password' => bcrypt('aishwarya2@123'),
                'role' => 'user',
                'address' => 'Sainbu, Lalitpur, Nepal'
            ],
            [
                'name' => 'Rajesh Khanna',
                'email' => 'rajesh.khanna@gmail.com',
                'password' => bcrypt('rajesh2@123'),
                'role' => 'user',
                'address' => 'Imadol, Lalitpur, Nepal'
            ],
            [
                'name' => 'Amitabh Bachchan',
                'email' => 'amitabh.bachchan@gmail.com',
                'password' => bcrypt('amitabh@123'),
                'role' => 'user',
                'address' => 'Gwarko, Lalitpur, Nepal'
            ],
            [
                'name' => 'Dilip Kumar',
                'email' => 'dilip.kumar@gmail.com',
                'password' => bcrypt('dilip@123'),
                'role' => 'user',
                'address' => 'Balkumari, Lalitpur, Nepal'
            ]
        ];

        shuffle($users);
        shuffle($users);

        // // Get 10 random keys
        // $randomUserKeys = array_rand($users, 0);

        // // Get the actual values
        // $randomUsers = array_map(fn($key) => $users[$key], $randomUserKeys);

        foreach ($users as $user) {
            \App\Models\User::updateOrCreate(['email' => $user['email']], [
                ...$user,
                'last_login_at' => Carbon::now()->subDays(rand(1, 365)),
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30))
            ]);
        }
    }
}
