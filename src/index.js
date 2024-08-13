/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
import { registerBlockType } from '@wordpress/blocks';
import { Icon } from '@wordpress/components';

/**
 * Internal dependencies
 */
import Edit from './edit';
import save from './save';
import metadata from './block.json';

const SOIcon = () => (
	<Icon
		icon={
			<svg
				viewBox="0 0 18 18"
				xmlns="http://www.w3.org/2000/svg"
				fill="#333333"
			>
				<path
					fillRule="evenodd"
					clipRule="evenodd"
					d="m13.57 1.08-.618-.62-.619.62-3.697 3.696 1.238 1.237 2.201-2.201.002 1.153c.003 1.777.006 3.545-.014 5.326-.112 2.219-1.78 4.286-3.928 4.734l-.013.003-.014.003c-1.889.459-4.038-.492-4.86-2.215l-.006-.014-.007-.013c-.774-1.486-.37-3.494.941-4.47l.013-.01.013-.01c1.13-.91 2.92-.85 3.894.157l.013.014.014.013c.529.5.736 1.22.736 2.26v.114h1.75v-.113c0-1.233-.24-2.534-1.268-3.518-1.658-1.699-4.458-1.71-6.223-.302-2.038 1.53-2.57 4.477-1.443 6.66 1.207 2.511 4.208 3.782 6.832 3.151 2.98-.63 5.165-3.418 5.305-6.377v-.031c.02-1.795.018-3.592.015-5.384l-.002-1.134 2.205 2.204 1.237-1.237z"
					fill="currentColor"
				/>
			</svg>
		}
	/>
);

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType( metadata.name, {
	icon: SOIcon,
	/**
	 * @see ./edit.js
	 */
	edit: Edit,

	/**
	 * @see ./save.js
	 */
	save,
} );
