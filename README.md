Turkish Dictionary
============

This resource is a dictionary of Modern Turkish, comprised of the definitions of over 50.000 individual entries. Each entry is matched with its corresponding synset (set of synonymous words and expressions) in the Turkish WordNet, KeNet.

The bare-forms in the lexicon consists of nouns, adjectives, verbs, adverbs, shortcuts, etc. Each bare-form appears the same in the lexicon except verbs. Since the bare-forms of the verbs in Turkish do not have the infinitive affix ‘mAk’, our lexicon includes all verbs without the infinitive affix. The bare-forms with diacritics are included in two forms, with and without diacritics. For example, noun ‘rüzgar’ appear both as ‘rüzgar’ and ‘rüzgâr’.

Special markers are included as bare-forms such as doc, s, etc.

Some compound words are included in their affixed form. For instance, ‘acemlalesi’ appears as it is, but not as ‘acemlale’.

Foreign words, especially proper noun foreign words, are included, so that the system can easily recognize them as proper nouns. For instance, the words ‘abbott’, ‘abbigail’ are example foreign proper nouns. Including foreign proper nouns, there are 19,000 proper nouns in our lexicon.

From derivational suffixes, we only include words which has taken -lI, -sIz, -CI, -lIk, and -CIlIk derivational affixes. For example, the bare-forms ‘abacı’, ‘abdallık’, ‘abdestli’ and ‘abdestlilik’, are included, since they have taken one or more derivational affixes listed above.

Each bare-form has a set of attributes. For instance, ‘abacı’ is a noun, therefore, it includes CL_ISIM attribute. Similarly, ‘abdestli’ is an adjective, which includes IS_ADJ attribute. If the bare-form has homonyms with different part of speech tags, all corresponding attributes are included.

|Name|Purpose|
|---|---|
|CL ISIM, CL FIIL, IS_OA|Part of speech tag(s)|
|IS_DUP|Part of a duplicate form|
|IS_KIS|Abbreviation, which does not obey vowel harmony while taking suffixes.|
|IS_UU, IS_UUU|Does not obey vowel harmony while taking suffixes.|
|IS_BILES|A portmanteau word in affixed form, such as ‘adamotu’|
|IS_B_SI|A portmanteau word ending with ‘sı’, such as ‘acemlalesi’|
|IS_CA|Already in a plural form, therefore can not take plural suffixes such as ‘ler’ or ‘lar’.|
|IS_ST|The second consonant undergoes a resyllabification.|
|IS_UD, IS_UDD, F_UD|Includes vowel epenthesis.|
|IS_KG|Ends with a ‘k’, and when it is followed by a vowel-initial suffix, the final ‘k’ is replaced with a ‘g’.|
|IS_SD, IS_SDD, F_SD|Final consonant gets devoiced during vowel-initial suffixation.|
|F GUD, F_GUDO|The verb bare-form includes vowel reduction.|
|F1P1, F1P1-NO-REF|A verb, and depending on this attribute, the verb can (or can not) take causative suffix, factitive suffix, passive suffix etc.|

Simple Web Interface
============
[Turkish Dictionary Search Link 1](http://104.247.163.162/nlptoolkit/turkish-dictionary.html) [Turkish Dictionary Search Link 2](https://starlangsoftware.github.io/nlptoolkit-web-simple/turkish-dictionary.html)

[Turkish MorphoLex Search Link 1](http://104.247.163.162/nlptoolkit/turkish-morphological-lexicon.html) [Turkish MorphoLex Search Link 2](https://starlangsoftware.github.io/nlptoolkit-web-simple/turkish-morphological-lexicon.html)

Video Lectures
============

[<img src="https://github.com/StarlangSoftware/Dictionary/blob/master/video1.jpg" width="50%">](https://youtu.be/10iAqbfsA2A)[<img src="https://github.com/StarlangSoftware/Dictionary/blob/master/video2.jpg" width="50%">](https://youtu.be/C-_TZDkFwzQ)

For Developers
============

You can also see [Python](https://github.com/starlangsoftware/Dictionary-Py), [Cython](https://github.com/starlangsoftware/Dictionary-Cy), [C++](https://github.com/starlangsoftware/Dictionary-CPP), [Swift](https://github.com/starlangsoftware/Dictionary-Swift), [C](https://github.com/starlangsoftware/Dictionary-C), [Js](https://github.com/starlangsoftware/Dictionary-Js), [Java](https://github.com/starlangsoftware/Dictionary), or [C#](https://github.com/starlangsoftware/Dictionary-CS) repository.

For Contibutors
============

### composer.json file

1. autoload is important when this package will be imported.
```
  "autoload": {
    "psr-4": {
      "olcaytaner\\WordNet\\": "src/"
    }
  },
```
2. Dependencies should be maximum (not only direct but also indirect references should also be given), everything directly in the code should be given here.
```
  "require-dev": {
    "phpunit/phpunit": "11.4.0",
    "olcaytaner/dictionary": "1.0.0",
    "olcaytaner/xmlparser": "1.0.1",
    "olcaytaner/morphologicalanalysis": "1.0.0"
  }
```

### Data files
1. Add data files to the project folder. Subprojects should include all data files of the parent projects.

### Php files

1. Do not forget to comment each function.
```
    /**
     * Returns true if specified semantic relation type presents in the relations list.
     *
     * @param SemanticRelationType $relationType element whose presence in the list is to be tested
     * @return bool true if specified semantic relation type presents in the relations list
     */
    public function containsRelationType(SemanticRelationType $relationType): bool{
        foreach ($this->relations as $relation){
            if ($relation instanceof SematicRelation && $relation->getRelationType() == $relationType){
                return true;
            }
        }
        return false;
    }
```
2. Function names should follow caml case.
```
    public function getRelation(int $index): Relation{
```
3. Write getter and setter methods.
```
    public function getOrigin(): ?string
    public function setName(string $name): void
```
4. Use standard javascript test style by extending the TestCase class. Use setup when necessary.
```
class WordNetTest extends TestCase
{
    private WordNet $turkish;

    protected function setUp(): void
    {
        ini_set('memory_limit', '450M');
        $this->turkish = new WordNet();
    }

    public function testSize()
    {
        $this->assertEquals(78327, $this->turkish->size());
    }
```
5. Enumerated types should be declared with enum.
```
enum CategoryType
{
    case MATHEMATICS;
    case SPORT;
    case MUSIC;
    case SLANG;
    case BOTANIC;
```
6. If there are multiple constructors for a class, define them as constructor1, constructor2, ..., then from the original constructor call these methods.
```
    public function constructor1(string $path, string $fileName): void
    public function constructor2(string $path, string $extension, int $index): void
    public function __construct(string $path, string $extension, ?int $index = null)
```
7. Use __toString method if necessary to create strings from objects.
```
    public function __toString(): string
```
8. Use xmlparser package for parsing xml files.
```
  $doc = new XmlDocument("../test.xml");
  $doc->parse();
  $root = $doc->getFirstChild();
  $firstChild = $root->getFirstChild();
```
