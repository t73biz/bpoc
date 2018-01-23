<?php
namespace Drupal\t73biz\bpoc\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'BPOC' Block
 *
 * @Block(
 *   id = "t73_bpoc_block",
 *   admin_label = @Translation("BPOC block"),
 * )
 */
class BpocBlock extends BlockBase implements BlockPluginInterface
{
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
            $name = $this->t('World');
        }

        // We pass in the configuration variable `name` here as a data attribute rather than passing it to the script
        // as we want React to use the dom for this. Passing in via the script might be better for larger data sets.
        return array(
            '#markup' => $this->t('<div id="bpoc-root" data-name="@name"></div>', ['@name' => $name,]),
            '#attached' => array(
                'library' => array(
                    'bpoc/bpoc',
                ),
            ),
        );
    }

    /**
     * Gets default configuration for this plugin.
     *
     * @return array
     *   An associative array with the default configuration.
     */
    public function defaultConfiguration() {
        $default_config = \Drupal::config('bpoc.settings');
        return [
            'bpoc_block_name' => $default_config->get('bpoc.name'),
        ];
    }

    /**
     * Returns the configuration form elements specific to this block plugin.
     *
     * Blocks that need to add form elements to the normal block configuration
     * form should implement this method.
     *
     * @param array $form
     *   The form definition array for the block configuration form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     *
     * @return array
     *   The renderable form array representing the entire configuration form.
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
     * Adds block type-specific submission handling for the block form.
     *
     * Note that this method takes the form structure and form state for the full
     * block configuration form as arguments, not just the elements defined in
     * BlockPluginInterface::blockForm().
     *
     * @param array $form
     *   The form definition array for the full block configuration form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     *
     * @see \Drupal\Core\Block\BlockPluginInterface::blockForm()
     * @see \Drupal\Core\Block\BlockPluginInterface::blockValidate()
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        $this->configuration['bpoc_block_name'] = $form_state->getValue('bpoc_block_name');
    }
}