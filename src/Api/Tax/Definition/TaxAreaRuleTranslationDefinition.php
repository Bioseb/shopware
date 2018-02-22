<?php declare(strict_types=1);

namespace Shopware\Api\Tax\Definition;

use Shopware\Api\Entity\EntityDefinition;
use Shopware\Api\Entity\EntityExtensionInterface;
use Shopware\Api\Entity\Field\FkField;
use Shopware\Api\Entity\Field\ManyToOneAssociationField;
use Shopware\Api\Entity\Field\ReferenceVersionField;
use Shopware\Api\Entity\Field\StringField;
use Shopware\Api\Entity\Field\VersionField;
use Shopware\Api\Entity\FieldCollection;
use Shopware\Api\Entity\Write\Flag\PrimaryKey;
use Shopware\Api\Entity\Write\Flag\Required;
use Shopware\Api\Shop\Definition\ShopDefinition;
use Shopware\Api\Tax\Collection\TaxAreaRuleTranslationBasicCollection;
use Shopware\Api\Tax\Collection\TaxAreaRuleTranslationDetailCollection;
use Shopware\Api\Tax\Event\TaxAreaRuleTranslation\TaxAreaRuleTranslationDeletedEvent;
use Shopware\Api\Tax\Event\TaxAreaRuleTranslation\TaxAreaRuleTranslationWrittenEvent;
use Shopware\Api\Tax\Repository\TaxAreaRuleTranslationRepository;
use Shopware\Api\Tax\Struct\TaxAreaRuleTranslationBasicStruct;
use Shopware\Api\Tax\Struct\TaxAreaRuleTranslationDetailStruct;

class TaxAreaRuleTranslationDefinition extends EntityDefinition
{
    /**
     * @var FieldCollection
     */
    protected static $primaryKeys;

    /**
     * @var FieldCollection
     */
    protected static $fields;

    /**
     * @var EntityExtensionInterface[]
     */
    protected static $extensions = [];

    public static function getEntityName(): string
    {
        return 'tax_area_rule_translation';
    }

    public static function getFields(): FieldCollection
    {
        if (self::$fields) {
            return self::$fields;
        }

        self::$fields = new FieldCollection([
            (new FkField('tax_area_rule_id', 'taxAreaRuleId', TaxAreaRuleDefinition::class))->setFlags(new PrimaryKey(), new Required()),
            new VersionField(),

            (new FkField('language_id', 'languageId', ShopDefinition::class))->setFlags(new PrimaryKey(), new Required()),
            (new ReferenceVersionField(ShopDefinition::class, 'language_version_id'))->setFlags(new PrimaryKey(), new Required()),

            (new StringField('name', 'name'))->setFlags(new Required()),
            new ManyToOneAssociationField('taxAreaRule', 'tax_area_rule_id', TaxAreaRuleDefinition::class, false),
            new ManyToOneAssociationField('language', 'language_id', ShopDefinition::class, false),
        ]);

        foreach (self::$extensions as $extension) {
            $extension->extendFields(self::$fields);
        }

        return self::$fields;
    }

    public static function getRepositoryClass(): string
    {
        return TaxAreaRuleTranslationRepository::class;
    }

    public static function getBasicCollectionClass(): string
    {
        return TaxAreaRuleTranslationBasicCollection::class;
    }

    public static function getDeletedEventClass(): string
    {
        return TaxAreaRuleTranslationDeletedEvent::class;
    }

    public static function getWrittenEventClass(): string
    {
        return TaxAreaRuleTranslationWrittenEvent::class;
    }

    public static function getBasicStructClass(): string
    {
        return TaxAreaRuleTranslationBasicStruct::class;
    }

    public static function getTranslationDefinitionClass(): ?string
    {
        return null;
    }

    public static function getDetailStructClass(): string
    {
        return TaxAreaRuleTranslationDetailStruct::class;
    }

    public static function getDetailCollectionClass(): string
    {
        return TaxAreaRuleTranslationDetailCollection::class;
    }
}