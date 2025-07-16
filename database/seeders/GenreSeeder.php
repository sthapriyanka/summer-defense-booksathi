<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Genre::truncate();
        $genres = [
            ['name' => 'Fiction', 'color' => 'indigo-600', 'icon' => 'book-open', 'description' => 'Narrative literary works created from the imagination, not presented as fact.'],
            ['name' => 'Romance', 'color' => 'rose-500', 'icon' => 'heart', 'description' => 'Focuses on relationships, love stories, and emotional connections.'],
            ['name' => 'Thriller', 'color' => 'red-600', 'icon' => 'exclamation-triangle', 'description' => 'Characterized by suspense, tension, and excitement, often with high stakes.'],
            ['name' => 'Classic', 'color' => 'yellow-700', 'icon' => 'archive-box', 'description' => 'Timeless literary works recognized for their artistic or historical significance.'],
            ['name' => 'Historical', 'color' => 'amber-600', 'icon' => 'clock', 'description' => 'Set in the past, exploring historical settings, characters, or events.'],
            ['name' => 'Poetry', 'color' => 'cyan-600', 'icon' => 'musical-note', 'description' => 'Literary expression through rhythmic and metaphorical language.'],
            ['name' => 'Magical Realism', 'color' => 'violet-600', 'icon' => 'sparkles', 'description' => 'Blends fantastical elements into realistic narratives with subtle magic.'],
            ['name' => 'Self-help', 'color' => 'green-600', 'icon' => 'lifebuoy', 'description' => 'Offers guidance for personal improvement and problem-solving strategies.'],
            ['name' => 'Productivity', 'color' => 'blue-600', 'icon' => 'presentation-chart-line', 'description' => 'Focuses on time management, efficiency, and self-optimization techniques.'],
            ['name' => 'Philosophy', 'color' => 'stone-600', 'icon' => 'question-mark-circle', 'description' => 'Explores fundamental questions about existence, reason, and ethics.'],
            ['name' => 'Political', 'color' => 'orange-700', 'icon' => 'scale', 'description' => 'Addresses political ideologies, power dynamics, and governance.'],
            ['name' => 'Motivational', 'color' => 'emerald-500', 'icon' => 'fire', 'description' => 'Encourages readers to take action, develop confidence, and pursue goals.'],
            ['name' => 'Fantasy', 'color' => 'purple-600', 'icon' => 'moon', 'description' => 'Involves magical worlds, mythical creatures, and epic adventures.'],
            ['name' => 'Adventure', 'color' => 'lime-600', 'icon' => 'map', 'description' => 'Centers around exciting journeys and explorations of the unknown.'],
            ['name' => 'Dystopian', 'color' => 'neutral-700', 'icon' => 'eye-slash', 'description' => 'Depicts oppressive societies and bleak futures as cautionary tales.'],
            ['name' => 'Contemporary', 'color' => 'sky-500', 'icon' => 'globe-alt', 'description' => 'Reflects modern-day themes, characters, and societal issues.'],
            ['name' => 'Mystery', 'color' => 'teal-600', 'icon' => 'magnifying-glass', 'description' => 'Involves solving crimes, puzzles, or uncovering secrets.'],
            ['name' => 'Humor', 'color' => 'amber-500', 'icon' => 'face-smile', 'description' => 'Literature intended to provoke laughter through wit and satire.'],
            ['name' => 'Science Fiction', 'color' => 'blue-900', 'icon' => 'rocket-launch', 'description' => 'Speculative fiction based on futuristic science and advanced technology.'],
            ['name' => 'War', 'color' => 'red-800', 'icon' => 'shield-check', 'description' => 'Centers on military conflict, battlefield experiences, and their aftermath.'],
            ['name' => 'Inspirational', 'color' => 'yellow-500', 'icon' => 'light-bulb', 'description' => 'Stories and biographies designed to uplift and encourage.'],
            ['name' => 'Social Drama', 'color' => 'fuchsia-600', 'icon' => 'users', 'description' => 'Explores societal conflicts, class struggles, and moral dilemmas.'],
            ['name' => 'Psychology', 'color' => 'indigo-800', 'icon' => 'cube-transparent', 'description' => 'Examines the human mind, behavior, and mental health.'],
            ['name' => 'Coming of Age', 'color' => 'rose-700', 'icon' => 'academic-cap', 'description' => 'Follows a protagonist’s transition from youth to adulthood.'],
            ['name' => 'Social', 'color' => 'gray-500', 'icon' => 'hand-raised', 'description' => 'Literature addressing social values, norms, and transformation.'],
            ['name' => 'Mythology', 'color' => 'yellow-600', 'icon' => 'sun', 'description' => 'Narratives rooted in traditional myths and ancient lore.'],
            ['name' => 'Family Saga', 'color' => 'orange-500', 'icon' => 'home-modern', 'description' => 'Spans generations, focusing on family dynamics and heritage.'],
            ['name' => 'Literary Fiction', 'color' => 'gray-700', 'icon' => 'bookmark', 'description' => 'Emphasizes character development and stylistic depth over plot.'],
            ['name' => 'Psychological', 'color' => 'purple-800', 'icon' => 'eye', 'description' => 'Explores the internal thoughts, feelings, and motivations of characters.'],
            ['name' => 'Manga', 'color' => 'zinc-600', 'icon' => 'film', 'description' => 'Japanese graphic novels with diverse genres and art styles.'],
            ['name' => 'Action', 'color' => 'red-500', 'icon' => 'bolt', 'description' => 'High-energy stories with physical feats, conflict, and combat.'],
            ['name' => 'Superhero', 'color' => 'yellow-400', 'icon' => 'sparkles', 'description' => 'Features protagonists with extraordinary powers or abilities.'],
            ['name' => 'Comedy', 'color' => 'amber-400', 'icon' => 'face-smile', 'description' => 'Literature intended to entertain and amuse through humor.'],
            ['name' => 'Children', 'color' => 'green-400', 'icon' => 'puzzle-piece', 'description' => 'Books aimed at young readers, often moral or educational in nature.'],
            ['name' => 'Manhwa', 'color' => 'rose-400', 'icon' => 'photo', 'description' => 'Korean comics distinct in art and storytelling from manga.'],
            ['name' => 'Supernatural', 'color' => 'violet-500', 'icon' => 'swatch', 'description' => 'Involves phenomena beyond scientific understanding such as ghosts or spirits.'],
            ['name' => 'Hard SF', 'color' => 'cyan-800', 'icon' => 'cpu-chip', 'description' => 'Subgenre of science fiction with emphasis on scientific accuracy.'],
            ['name' => 'Existential', 'color' => 'slate-600', 'icon' => 'question-mark-circle', 'description' => 'Explores existential themes of meaning, freedom, and absurdity.'],
            ['name' => 'Philosophical', 'color' => 'gray-700', 'icon' => 'light-bulb', 'description' => 'Fiction driven by philosophical ideas and contemplative depth.'],
            ['name' => 'Gothic', 'color' => 'black', 'icon' => 'moon', 'description' => 'Dark, mysterious settings often involving horror or romance.'],
            ['name' => 'Leadership', 'color' => 'blue-700', 'icon' => 'user-group', 'description' => 'Strategies and insights on guiding teams and making impactful decisions.'],
            ['name' => 'Communication', 'color' => 'teal-500', 'icon' => 'chat-bubble-left-right', 'description' => 'Focuses on interpersonal and professional communication techniques.'],
            ['name' => 'Spirituality', 'color' => 'amber-700', 'icon' => 'sparkles', 'description' => 'Explores metaphysical beliefs, inner peace, and transcendence.'],
            ['name' => 'Finance', 'color' => 'emerald-700', 'icon' => 'banknotes', 'description' => 'Relates to money management, wealth-building, and economic theory.'],
            ['name' => 'Investment', 'color' => 'lime-700', 'icon' => 'chart-bar', 'description' => 'Strategies for growing assets and understanding financial instruments.'],
        ];

        foreach ($genres as $genre) {
            \App\Models\Genre::updateOrCreate($genre);
        }
        Schema::enableForeignKeyConstraints();
    }
}
