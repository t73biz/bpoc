<?php
namespace Drupal\bpoc\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'BPOC' Block
 *
 * @Block(
 *   id = "bpoc_block",
 *   admin_label = @Translation("BPOC block"),
 * )
 */
class BpocBlock extends BlockBase implements BlockPluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        $default_config = \Drupal::config('bpoc.settings');
        return [
            'bpoc_block_name' => $default_config->get('bpoc.name'),
        ];
    }

    /**
     * Builds and returns the renderable array for this block plugin.
     *
     * If a block should not be rendered because it has no content, then this
     * method must also ensure to return no content: it must then only return an
     * empty array, or an empty array with #cache set (with cacheability metadata
     * indicating the circumstances for it being empty).
     *
     * @return array
     *   A renderable array representing the content of the block.
     *
     * @see \Drupal\block\BlockViewBuilder
     */
    public function build()
    {
        $config = $this->getConfiguration();

        if (!empty($config['bpoc_block_name'])) {
            $name = $config['bpoc_block_name'];
        }
        else {
            $name = $this->t('to no one');
        }
        return array(
            '#markup' => $this->t('<div id="bpoc-root" data-name="@name"></div>', array(
                '@name' => $name,
            )),
            '#attached' => array(
                'library' => array(
                    'bpoc/bpoc',
                ),
            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $form = parent::blockForm($form, $form_state);

        $config = $this->getConfiguration();

        $form['bpoc_block_name'] = array (
            '#type' => 'textfield',
            '#title' => $this->t('Who'),
            '#description' => $this->t('Who do you want to say hello to?'),
            '#default_value' => isset($config['bpoc_block_name']) ? $config['bpoc_block_name'] : ''
        );

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        $this->configuration['bpoc_block_name'] = $form_state->getValue('bpoc_block_name');
    }
}