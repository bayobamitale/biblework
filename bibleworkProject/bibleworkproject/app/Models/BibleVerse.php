namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BibleVerse extends Model
{
    protected $table = 'bible_version_key'; // Update this to match your table name

    protected $fillable = [
        'table',
        'abbreviation',
        'language',
        'version',
        
    ];
}