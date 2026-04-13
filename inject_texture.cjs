const fs = require('fs');
const src = fs.readFileSync('resources/js/components/perspective-book.tsx', 'utf-8');
const dst = fs.readFileSync('resources/js/components/ui/perspective-book.tsx', 'utf-8');

// Match the background image data URL precisely
const regex = /backgroundImage:\s*"url\((data:image\/avif;base64,[A-Za-z0-9+/=]+)\)"/;
const match = src.match(regex);

if (match) {
    const bgUrl = match[1];
    
    // Create the exact texture component we want
    const block = `
          {textured && (
            <div
              className="absolute inset-0 mix-blend-hard-light rotate-180 opacity-50 brightness-110 bg-no-repeat bg-cover pointer-events-none"
              style={{
                borderRadius: "6px 4px 4px 6px",
                backgroundImage: "url(" + "${bgUrl}" + ")",
              }}
            />
          )}`;

    let newDst = dst;
    
    // 1. Add textured prop:
    newDst = newDst.replace('color?: string;\n}', 'color?: string;\n  textured?: boolean;\n}');
    // 2. Add as param with default true:
    newDst = newDst.replace('color = "#1e3a8a",', 'color = "#1e3a8a",\n  textured = true,');
    
    // 3. Inject it inside the Front Cover before the closing div
    newDst = newDst.replace('          )}\n        </div>\n\n        {/* Spine */}','          )}\n' + block + '\n        </div>\n\n        {/* Spine */}');
    
    fs.writeFileSync('resources/js/components/ui/perspective-book.tsx', newDst);
    console.log('success');
} else {
    console.log('no match');
}
