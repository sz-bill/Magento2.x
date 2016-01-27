<?php
namespace Sample\News\Controller\Adminhtml\Author;

use Magento\Framework\Registry;
use Sample\News\Controller\Adminhtml\Author;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use Sample\News\Model\AuthorFactory;
use Magento\Backend\Model\Session;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\Exception\LocalizedException;
use Sample\News\Model\Author\Image as ImageModel;
use Sample\News\Model\Author\File as FileModel;
use Sample\News\Model\Upload;
use Magento\Backend\Helper\Js as JsHelper;

class Save extends Author
{
    /**
     * author factory
     * @var \Sample\News\Model\AuthorFactory
     */
    protected $authorFactory;

    /**
     * image model
     *
     * @var \Sample\News\Model\Author\Image
     */
    protected $imageModel;

    /**
     * file model
     *
     * @var \Sample\News\Model\Author\File
     */
    protected $fileModel;

    /**
     * upload model
     *
     * @var \Sample\News\Model\Upload
     */
    protected $uploadModel;

    /**
     * @var \Magento\Backend\Helper\Js
     */
    protected $jsHelper;


    /**
     * @param JsHelper $jsHelper
     * @param Session $backendSession
     * @param Date $dateFilter
     * @param ImageModel $imageModel
     * @param FileModel $fileModel
     * @param Upload $uploadModel
     * @param Registry $registry
     * @param AuthorFactory $authorFactory
     * @param RedirectFactory $resultRedirectFactory
     * @param Context $context
     */
    public function __construct(
        JsHelper $jsHelper,

        ImageModel $imageModel,
        FileModel $fileModel,
        Upload $uploadModel,
        Registry $registry,
        AuthorFactory $authorFactory,
        RedirectFactory $resultRedirectFactory,
        Date $dateFilter,
        Context $context
    )
    {
        $this->jsHelper = $jsHelper;
        $this->imageModel = $imageModel;
        $this->fileModel = $fileModel;
        $this->uploadModel = $uploadModel;
        parent::__construct($registry, $authorFactory, $resultRedirectFactory, $dateFilter, $context);
    }

    /**
     * run the action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPost('author');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data = $this->filterData($data);
            $author = $this->initAuthor();
            $author->setData($data);
            $avatar = $this->uploadModel->uploadFileAndGetName('avatar', $this->imageModel->getBaseDir(), $data);
            $author->setAvatar($avatar);
            $resume = $this->uploadModel->uploadFileAndGetName('resume', $this->fileModel->getBaseDir(), $data);
            $author->setResume($resume);
            $products = $this->getRequest()->getPost('products', -1);
            if ($products != -1) {
                $author->setProductsData($this->jsHelper->decodeGridSerializedInput($products));
            }
            $this->_eventManager->dispatch(
                'sample_news_author_prepare_save',
                [
                    'author' => $author,
                    'request' => $this->getRequest()
                ]
            );
            try {
                $author->save();
                $this->messageManager->addSuccess(__('The author has been saved.'));
                $this->_getSession()->setSampleNewsAuthorData(false);
                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath(
                        'sample_news/*/edit',
                        [
                            'author_id' => $author->getId(),
                            '_current' => true
                        ]
                    );
                    return $resultRedirect;
                }
                $resultRedirect->setPath('sample_news/*/');
                return $resultRedirect;
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the author.'));
            }

            $this->_getSession()->setSampleNewsAuthorData($data);
            $resultRedirect->setPath(
                'sample_news/*/edit',
                [
                    'author_id' => $author->getId(),
                    '_current' => true
                ]
            );
            return $resultRedirect;
        }
        $resultRedirect->setPath('sample_news/*/');
        return $resultRedirect;
    }
}
