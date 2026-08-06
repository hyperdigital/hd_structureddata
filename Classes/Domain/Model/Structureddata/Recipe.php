<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

class Recipe extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Recipe';
        $return['name'] = $this->originalRow['title'] ?? '';
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }
        if (!empty($this->originalRow['authors'])) {
            $people = $this->getPeople($this->originalRow['uid'], 'authors', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($people)) {
                $return['author'] = $people;
            }
        }
        if (!empty($this->originalRow['date_published'])) {
            $date = new \DateTime($this->originalRow['date_published']);
            $return['datePublished'] = $date->format(DATE_ATOM);
        }

        $prep = $this->minutesToDuration($this->originalRow['prep_time'] ?? null);
        $cook = $this->minutesToDuration($this->originalRow['cook_time'] ?? null);
        if ($prep) {
            $return['prepTime'] = $prep;
        }
        if ($cook) {
            $return['cookTime'] = $cook;
        }
        if ($prep || $cook) {
            $total = (int)($this->originalRow['prep_time'] ?? 0) + (int)($this->originalRow['cook_time'] ?? 0);
            $return['totalTime'] = $this->minutesToDuration($total);
        }

        if (!empty($this->originalRow['recipe_yield'])) {
            $return['recipeYield'] = $this->originalRow['recipe_yield'];
        }
        if (!empty($this->originalRow['recipe_category'])) {
            $return['recipeCategory'] = $this->originalRow['recipe_category'];
        }
        if (!empty($this->originalRow['recipe_cuisine'])) {
            $return['recipeCuisine'] = $this->originalRow['recipe_cuisine'];
        }
        if (!is_null($this->originalRow['calories'] ?? null)) {
            $return['nutrition'] = [
                '@type' => 'NutritionInformation',
                'calories' => $this->originalRow['calories'] . ' calories'
            ];
        }
        if (!empty($this->originalRow['ingredients'])) {
            $ingredients = $this->getIngredients($this->originalRow['uid'], 'ingredients', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($ingredients)) {
                $return['recipeIngredient'] = $ingredients;
            }
        }
        if (!empty($this->originalRow['instructions'])) {
            $instructions = $this->getInstructions($this->originalRow['uid'], 'instructions', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($instructions)) {
                $return['recipeInstructions'] = $instructions;
            }
        }

        $rating = $this->getRating('AggregateRating');
        if (!empty($rating)) {
            $return['aggregateRating'] = $rating;
        }

        return $return;
    }

    /**
     * Editors enter whole minutes; schema.org expects an ISO 8601 duration.
     *
     * @param int|null $minutes
     * @return string|false
     */
    protected function minutesToDuration($minutes)
    {
        if (is_null($minutes) || (int)$minutes <= 0) {
            return false;
        }

        $minutes = (int)$minutes;
        $hours = intdiv($minutes, 60);
        $rest = $minutes % 60;

        return 'PT' . ($hours ? $hours . 'H' : '') . ($rest ? $rest . 'M' : '');
    }
}
