<?php

namespace App\Helpers;

use App\DataTransferObjects\TranslatableDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Modules\Translation\Entities\Translation;

class Translator
{
    public static function getAll($model, array $fields = ['id'])
    {

        $data = $model::select($fields)->with(static::translateRelation())
            ->get()->toArray();
        $formattedData = [];
        foreach ($data as $model) {
            $formattedData[] = static::format($model);
        }
        return $formattedData;
    }

    public static function getAllRaw($model)
    {
        return $model::select(['id'])->with([
            'translations' => fn ($query) => $query->allTranslations()
        ]);
    }
    public static function format(array $model)
    {
        $data =
            [
                ...$model,
                'name' => $model['translations'][0]['translate'],
            ];
        unset($data['translations']);
        return $data;
    }
    public static function formatModel(Model $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->translations->first()->translate,
        ];
    }
    public static function translateRelation()
    {
        return ['translations' => fn ($query) => $query->translate()];
    }
    public static function formatPagination(Builder $query, array $fields = ['id'])
    {
        $rawData = $query->select($fields)->with(Translator::translateRelation())
            ->paginate(15);
        $formattedData = \collect($rawData->items())
            ->map(function ($model) {
                $model->name = $model->translations->first()->translate;
                return $model;
            });
        $rawData->setCollection($formattedData);
        return $rawData;
    }
    public static function insertTranslations(TranslatableDto $translatableDto, array $translations)
    {
        $formattedTranslations = [];
        foreach ($translations as $locale => $name) {
            $formattedTranslations[] = [
                'translate' => $name,
                'locale' => $locale,
                ...$translatableDto->toArray()
            ];
        }
        Translation::insert($formattedTranslations);
    }
}