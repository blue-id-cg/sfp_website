<?php

namespace Database\Seeders;

use App\Models\ContentBlock;
use App\Models\Trade;
use Illuminate\Database\Seeder;

class TradesSeeder extends Seeder
{
    /**
     * Run the database seeds. Trades used to live as ContentBlock rows in the "trades" group;
     * they're now a first-class model with a slug and a long-form body, so each métier can have
     * its own detail page instead of just a card on resources/views/metiers/index.blade.php.
     */
    public function run(): void
    {
        $trades = [
            [
                'slug' => 'forage-petrolier',
                'icon' => 'hgi-factory-01',
                'title' => 'Forage pétrolier',
                'description' => "Réalisation de puits d'exploration, d'évaluation et de production, avec des protocoles de sécurité stricts et un pilotage précis des paramètres.",
                'body' => "<p>Forer un puits, c'est creuser un trou très étroit — quelques dizaines de centimètres de diamètre — mais très profond, parfois plus de 3 000 mètres, jusqu'à la couche de roche qui contient le pétrole. Pour cela, un appareil de forage fait tourner un outil de coupe au bout d'un long train de tiges métalliques, comme une perceuse géante plantée verticalement dans le sol.</p><h3>Concrètement, sur le terrain</h3><ul><li>Assembler et descendre les tiges de forage, section par section, à mesure que le puits s'approfondit.</li><li>Faire tourner l'outil de forage tout en surveillant en permanence sa vitesse, le poids appliqué et la pression du fluide de forage.</li><li>Tuber et cimenter chaque section du puits avant de poursuivre plus profond, pour en consolider les parois.</li><li>Rester en contact constant avec l'équipe de mud logging, qui suit l'avancement et les signaux du sous-sol en temps réel.</li></ul><h3>Pourquoi c'est un métier exigeant</h3><p>Chaque décision se prend à plusieurs kilomètres de distance de ce qui se passe réellement au fond du puits, uniquement à partir de mesures indirectes. La rigueur et le respect scrupuleux des procédures de sécurité sont donc non négociables, du chef de poste jusqu'au dernier opérateur sur le plancher de forage.</p>",
                'position' => 1,
            ],
            [
                'slug' => 'completion',
                'icon' => 'hgi-layers-01',
                'title' => 'Complétion',
                'description' => 'Équipement et mise en production des puits pour garantir un débit optimal, durable et conforme aux exigences du réservoir.',
                'body' => "<p>Un puits fraîchement foré n'est encore qu'un trou vide : il faut l'équiper pour qu'il puisse laisser remonter le pétrole en toute sécurité, un peu comme on installe la plomberie et les vannes d'une canalisation avant de l'ouvrir. C'est le rôle de la complétion.</p><h3>Concrètement, sur le terrain</h3><ul><li>Descendre le tubing — le tube métallique qui conduira les hydrocarbures jusqu'en surface — au cœur du puits.</li><li>Poser des packers, des joints d'étanchéité qui isolent les différentes zones du puits les unes des autres.</li><li>Installer et raccorder la tête de puits, l'équipement visible en surface qui contrôle l'accès au puits.</li><li>Tester l'étanchéité et la pression de chaque équipement avant la mise en production.</li></ul><h3>Pourquoi c'est essentiel</h3><p>Une complétion bien conçue conditionne la quantité de pétrole que le puits pourra produire pendant toute sa vie, parfois plusieurs dizaines d'années. Une erreur à cette étape est difficile et coûteuse à corriger une fois le puits en production.</p>",
                'position' => 2,
            ],
            [
                'slug' => 'work-over',
                'icon' => 'hgi-refresh',
                'title' => 'Work Over',
                'description' => 'Reprise, réparation et amélioration des performances des puits existants pour prolonger leur durée de vie et leur productivité.',
                'body' => "<p>Comme n'importe quelle installation industrielle, un puits vieillit : sa production peut décliner ou un équipement peut tomber en panne. Le work over consiste à rouvrir un puits déjà en production pour le réparer ou lui redonner de meilleures performances — l'équivalent d'une grosse opération de maintenance, mais sur un puits de pétrole.</p><h3>Concrètement, sur le terrain</h3><ul><li>Mettre le puits en sécurité avant toute intervention, pour travailler sans risque sur un puits déjà producteur.</li><li>Remonter et inspecter les équipements de fond usés ou défaillants.</li><li>Traiter les dépôts qui bouchent progressivement le passage du pétrole dans le puits.</li><li>Remettre le puits en production et vérifier que ses performances se sont bien améliorées.</li></ul><h3>Pourquoi c'est essentiel</h3><p>Forer un nouveau puits coûte beaucoup plus cher que d'en réparer un existant. Le work over permet de prolonger la vie utile d'un puits et d'en tirer davantage de valeur, souvent pendant plusieurs années supplémentaires.</p>",
                'position' => 3,
            ],
            [
                'slug' => 'mud-logging',
                'icon' => 'hgi-chart-line-data-01',
                'title' => 'Mud Logging',
                'description' => 'Suivi géologique en temps réel et analyse des données de forage pour une prise de décision éclairée à chaque phase.',
                'body' => "<p>Pendant qu'un puits se fore, personne ne peut voir ce qui se passe à des kilomètres sous terre. Le mud logging est la « boîte noire » du puits : une équipe installée dans une unité dédiée, tout près du plancher de forage, lit en continu ce que le sous-sol renvoie à la surface pour savoir exactement où l'on se trouve et ce que l'on traverse.</p><h3>Concrètement, sur le terrain</h3><ul><li>Enregistrer en continu la profondeur, la vitesse de forage, la pression et le débit du fluide de forage.</li><li>Analyser les fragments de roche remontés par la boue pour identifier les couches géologiques traversées.</li><li>Surveiller les moindres indices de présence de gaz ou d'huile dans le puits.</li><li>Alerter immédiatement l'équipe de forage au moindre signe anormal de pression.</li></ul><h3>Pourquoi c'est essentiel</h3><p>C'est souvent le mud logging qui donne la première alerte en cas de problème de pression dans le puits — une fonction de sécurité aussi importante que son rôle d'aide à la décision technique.</p>",
                'position' => 4,
            ],
            [
                'slug' => 'pompage-filtration',
                'icon' => 'hgi-filter',
                'title' => 'Pompage & Filtration',
                'description' => 'Gestion complète des fluides techniques · du pompage à la filtration · pour des opérations propres, stables et efficaces.',
                'body' => "<p>Pendant le forage, un liquide spécial appelé « boue de forage » circule en permanence dans le puits : il refroidit l'outil qui creuse, remonte à la surface les débris de roche et empêche le puits de s'effondrer sur lui-même. Le pompage et la filtration, c'est tout le métier qui consiste à faire circuler et à nettoyer ce liquide vital, du début à la fin du forage.</p><h3>Concrètement, sur le terrain</h3><ul><li>Pomper la boue de forage dans le puits à un débit et une pression précisément contrôlés.</li><li>Séparer les débris de roche remontés du puits pour pouvoir réutiliser la boue.</li><li>Ajuster en continu les propriétés de la boue (sa densité, son épaisseur) selon ce que rencontre le forage.</li><li>Traiter et filtrer le fluide pour limiter le gaspillage et l'impact sur l'environnement.</li></ul><h3>Pourquoi c'est essentiel</h3><p>Une boue mal dosée ou mal contrôlée peut déstabiliser un puits en cours de forage. La qualité de ce fluide conditionne directement la sécurité et la réussite de toute l'opération.</p>",
                'position' => 5,
            ],
            [
                'slug' => 'casing-tubing',
                'icon' => 'hgi-settings-02',
                'title' => 'Casing & Tubing',
                'description' => 'Descente et vissage de casing et de tubing sur les puits en cours de forage ou de complétion.',
                'body' => "<p>Un trou creusé dans la terre a besoin d'être « tapissé » pour ne pas s'effondrer et pour empêcher les fluides du sous-sol de se mélanger entre eux — un peu comme on chemise un tunnel. C'est le rôle du casing : une colonne de gros tubes en acier, descendue dans le puits puis cimentée contre la roche. Le tubing, plus fin, vient ensuite à l'intérieur pour transporter le pétrole jusqu'en surface.</p><h3>Concrètement, sur le terrain</h3><ul><li>Lever et assembler chaque longueur de tube, une par une, à mesure qu'elles descendent dans le puits.</li><li>Visser chaque raccord avec un couple de serrage précis pour garantir une étanchéité parfaite.</li><li>Cimenter le casing contre la paroi du puits une fois la colonne complète descendue.</li><li>Contrôler l'étanchéité de l'ensemble avant de poursuivre les opérations suivantes.</li></ul><h3>Pourquoi c'est essentiel</h3><p>Le casing et le tubing forment le squelette du puits. Une erreur à cette étape peut compromettre la solidité du puits pour toute sa durée de vie, du forage jusqu'à son exploitation.</p>",
                'position' => 6,
            ],
        ];

        foreach ($trades as $trade) {
            Trade::query()->updateOrCreate(['slug' => $trade['slug']], $trade);
        }

        // Superseded by the dedicated Trade model above.
        ContentBlock::query()->where('group', 'trades')->delete();
    }
}
