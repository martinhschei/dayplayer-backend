<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\User;
use Dayplayer\BackendModels\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailVerificationCode extends BaseModel
{
    use HasFactory;

    protected $fillable = ['user_id', 'code'];

    public static function createForUser(User $user)
    {
        $attributes['user_id'] = $user->id;
        $attributes['code'] = self::generateFunnyCode();
        
        return EmailVerificationCode::create($attributes);
    }

    private static function generateFunnyCode()
    {
        $adjectives = [
            "Agile", "Blissful", "Curious", "Dazzling", "Eclectic",
            "Fluffy", "Gritty", "Humble", "Icy", "Jovial",
            "Keen", "Luminous", "Mystic", "Nimble", "Opulent",
            "Pristine", "Quirky", "Radiant", "Spunky", "Tranquil",
            "Upbeat", "Vivacious", "Whimsical", "Youthful", "Zealous",
            "Ample", "Boisterous", "Crafty", "Delightful", "Enigmatic",
            "Feisty", "Gleaming", "Hearty", "Inventive", "Jolly",
            "Kindly", "Lively", "Majestic", "Nifty", "Ornate",
            "Playful", "Quaint", "Robust", "Spirited", "Thorough",
            "Unique", "Versatile", "Witty", "Zany", "Affable",
            "Brisk", "Clever", "Dapper", "Earnest", "Fuzzy",
            "Gracious", "Hardy", "Intrepid", "Jaunty", "Knotty",
            "Luxurious", "Merry", "Nonchalant", "Observant", "Plucky",
            "Quick", "Resilient", "Serene", "Tactile", "Uplifting",
            "Velvety", "Wise", "Exuberant", "Yielding", "Zestful",
            "Animated", "Breezy", "Charming", "Dreamy", "Eloquent",
            "Fiery", "Golden", "Harmonious", "Impish", "Jubilant",
            "Knack", "Lavish", "Mirthful", "Nostalgic", "Obedient",
            "Piquant", "Quixotic", "Reliable", "Sly", "Twinkling",
            "Unassuming", "Vibrant", "Wholesome", "Xenon", "Yacht",
        ];

        $nouns = [
            "Unicorn", "Pancake", "Robot", "Pirate", "Ninja",
            "Astronaut", "Dragon", "Cupcake", "Wizard", "Castle",
            "Balloon", "Circus", "Diamond", "Eclipse", "Festival",
            "Galaxy", "Harbor", "Island", "Jewel", "Kitten",
            "Lagoon", "Meadow", "Nebula", "Oasis", "Parrot",
            "Quasar", "Rainbow", "Safari", "Tornado", "Universe",
            "Volcano", "Waterfall", "Xenon", "Yacht", "Zigzag",
            "Avalanche", "Bandit", "Champion", "Dynamo", "Enigma",
            "Frontier", "Glacier", "Helicopter", "Infinity", "Juggernaut",
            "Kaleidoscope", "Lantern", "Mirage", "Navigator", "Oracle",
            "Pinnacle", "Quill", "Renaissance", "Summit", "Tycoon",
            "Underdog", "Vanguard", "Willow", "Xylophone", "Yearbook",
            "Zenith", "Artifact", "Bravo", "Crusader", "Dune",
            "Emporium", "Fable", "Gondola", "Hurricane", "Idol",
            "Jackpot", "Keepsake", "Labyrinth", "Mammoth", "Nova",
            "Outlaw", "Phoenix", "Quest", "Rhapsody", "Sentinel",
            "Titan", "Utopia", "Visionary", "Wanderlust", "X-factor",
            "Yearling", "Zen", "Alchemy", "Battalion", "Century",
            "Dynasty", "Elixir", "Fragment", "Gargoyle", "Heirloom",
            "Illusion", "Jamboree", "Kernel", "Legend", "Minstrel",
        ];

        return $adjectives[array_rand($adjectives)] . ' ' . $nouns[array_rand($nouns)];
    }
}
