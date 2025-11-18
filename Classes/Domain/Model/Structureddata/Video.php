<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\VimeoHelper;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\YouTubeHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Video extends AbstractData
{
    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = ['VideoObject'];
        $return['name'] = $this->originalRow['title'] ?? '';
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['thumbnailUrl'] = $images;
            }
        }

        $fileRepository = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\FileRepository::class);
        $fileObjects = $fileRepository->findByRelation('tx_hdstructureddata_domain_model_structureddata', 'medias', $this->originalRow['uid']);
        foreach ($fileObjects as $fileObject) {
            $date = new \DateTime();
            $date->setTimestamp($fileObject->getOriginalFile()->getProperty('crdate'));
            $url = $this->getUrl($fileObject->getPublicUrl());

            if (empty($return['thumbnailUrl'])) {
                switch ($fileObject->getOriginalFile()->getExtension()) {
                    case 'youtube':
                        $youTubeHelper = GeneralUtility::makeInstance(YouTubeHelper::class, $fileObject->getOriginalFile()->getExtension());
                        $preview = $youTubeHelper->getPreviewImage($fileObject->getOriginalFile());
                        if ($preview) {
                            $preview = $this->getUrl(substr($preview, strlen(Environment::getPublicPath())));
                        }
                        break;
                    case 'vimeo':
                        $youTubeHelper = GeneralUtility::makeInstance(VimeoHelper::class, $fileObject->getOriginalFile()->getExtension());
                        $preview = $youTubeHelper->getPreviewImage($fileObject->getOriginalFile());
                        if ($preview) {
                            $preview = $this->getUrl(substr($preview, strlen(Environment::getPublicPath())));
                        }
                        break;
                }

                if ($preview) {
                    $return['thumbnailUrl'] = $preview;
                }
            }

            $return['uploadDate'] = $date->format(DATE_ATOM);
            if ($url) {
                if (
                    $fileObject->getOriginalFile()->getProperty('extension') == 'youtube'
                    || $fileObject->getOriginalFile()->getProperty('extension') == 'vimeo'
                ) {
                    $return['embedUrl'] = $url;
                } else {
                    $return['contentUrl'] = $url;
                }
            }
        }

        if (!empty($this->originalRow['clips'])) {
            $clips = $this->getClips($this->originalRow['uid'], 'clips', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($clips)) {
                $return['hasPart'] = $clips;
            }
        }

        if (empty($return['contentUrl']) && empty($return['embedUrl'])) {
            return false;
        }

        return $return;
    }
}
